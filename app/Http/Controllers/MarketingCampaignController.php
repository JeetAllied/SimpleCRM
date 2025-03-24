<?php

namespace App\Http\Controllers;

use App\Services\MarketingCampaignService\MarketingCampaignService;
use App\Services\MarketingCampaignTypeService\MarketingCampaignTypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarketingCampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $marketingCampaignService, $marketingCampaignTypeService;
    public function __construct(MarketingCampaignService $marketingCampaignService, MarketingCampaignTypeService $marketingCampaignTypeService)
    {
        $this->marketingCampaignService = $marketingCampaignService;
        $this->marketingCampaignTypeService = $marketingCampaignTypeService;
    }
    public function index()
    {
        return view('marketing_campaign.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $marketingCampaignTypes = $this->marketingCampaignTypeService->getAllMarketingCampaignTypes();
        return view('marketing_campaign.modal.create',compact('marketingCampaignTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'marketing_campaign_name'=>'required',
                'marketing_campaign_type_id' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ];
            $messages = [
                'marketing_campaign_name.required'=>'Please enter marketing campaign name.',
                'marketing_campaign_type_id.required'=> 'Please select marketing campaign type.',
                'start_date.required'=> 'Please select start date.',
                'end_date.required'=>'Please select end date.',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if($validator->fails())
            {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => $messages,
                    'errors' => $validator->errors(),
                    'old' => $request->all()
                ], 422);
            }
            $data = [
                'marketing_campaign_name'=>$request->marketing_campaign_name,
                'marketing_campaign_type_id' => $request->marketing_campaign_type_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ];

            $marketingCampaign = $this->marketingCampaignService->addMarketingCampaign($data);

            // Redirect based on the result
            if ($marketingCampaign) {
                if (is_array($marketingCampaign) && $marketingCampaign['status'] == 0) {
                    return response()->json([
                        'alertClass' => 'error',
                        'message' => $marketingCampaign['message']
                    ]);
                }
                return response()->json([
                    'alertClass' => 'success',
                    'message' => 'Marketing Campaign created successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error occurred in marketing campaign creation.',
                ]);
            }

        }
        catch(\Exception $e)
        {
            return response()->json([
                'alertClass' => 'error',
                'message' => 'An error occurred. Try Again!'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $marketingCampaignTypes = $this->marketingCampaignTypeService->getAllMarketingCampaignTypes();
        $marketingCampaign = $this->marketingCampaignService->getMarketingCampaignById($id);
        return view('marketing_campaign.modal.edit',compact('marketingCampaignTypes','marketingCampaign'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $rules = [
                'marketing_campaign_name'=>'required',
                'marketing_campaign_type_id' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ];

            $messages = [
                'marketing_campaign_name.required'=>'Please enter marketing campaign name.',
                'marketing_campaign_type_id.required'=> 'Please select marketing campaign type.',
                'start_date.required'=> 'Please select start date.',
                'end_date.required'=>'Please select end date.',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => $messages,
                    'errors' => $validator->errors(),
                    'old' => $request->all()
                ], 422);
            }

            $data = [
                'marketing_campaign_name'=>$request->marketing_campaign_name,
                'marketing_campaign_type_id' => $request->marketing_campaign_type_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ];

            $marketingCampaign = $this->marketingCampaignService->updateMarketingCampaign($data, $id);

            // Redirect based on the result
            if ($marketingCampaign) {
                if (is_array($marketingCampaign) && $marketingCampaign['status'] == 0) {
                    return response()->json([
                        'alertClass' => 'error',
                        'message' => $marketingCampaign['message']
                    ]);
                }
                return response()->json([
                    'alertClass' => 'success',
                    'message' => 'Marketing Campaign updated successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error occurred in updating marketing campaign.',
                ]);
            }
        }
        catch(\Exception $e)
        {
            return response()->json([
                'alertClass' => 'error',
                'message' => 'An error occurred. Try Again!'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->marketingCampaignService->deleteMarketingCampaign($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Marketing campaign has been deleted successfully!',
        ], 200);
    }

    public function getAllMarketingCampaigns()
    {
        try{
            return $this->marketingCampaignService->getAllMarketingCampaigns();
        }
        catch(\Exception $e)
        {

        }
    }
}
