<?php

namespace App\Http\Controllers;

use App\Services\MarketingCampaignTypeService\MarketingCampaignTypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarketingCampaignTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $marketingCampaignTypeService;
    public function __construct(MarketingCampaignTypeService $marketingCampaignTypeService){
        $this->marketingCampaignTypeService = $marketingCampaignTypeService;
    }
    public function index()
    {
        $marketingCampaignTypes = $this->marketingCampaignTypeService->getAllMarketingCampaignTypes();
        return view('marketing_campaign_type.index',compact('marketingCampaignTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('marketing_campaign_type.modal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'marketing_campaign_type_name'=> 'required',
            ];

            $messages = [
                'marketing_campaign_type_name.required'=> 'Please enter marketing campaign type.',
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

            // Validated data
            $validatedData = $validator->validated();

            //attempt to add the marketing campaign type
            $data = $this->marketingCampaignTypeService->addMarketingCampaignType($validatedData);

            // Redirect based on the result
            if ($data) {
                if (is_array($data) && $data['status'] == 0) {
                    return response()->json([
                        'alertClass' => 'error',
                        'message' => $data['message']
                    ]);
                }
                return response()->json([
                    'alertClass' => 'success',
                    'message' => 'Marketing campaign type created successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error occurred in marketing campaign type creation.'
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
        $marketingCampaignType = $this->marketingCampaignTypeService->getMarketingCampaignTypeById($id);
        return view('marketing_campaign_type.modal.edit',compact('marketingCampaignType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $rules = [
                'marketing_campaign_type_name'=>'required'
            ];
            $messages = [
                'marketing_campaign_type_name.required'=>'Please enter marketing campaign type.',
            ];
            $validator = Validator::make($request->all(),$rules, $messages);
            if($validator->fails())
            {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => $messages,
                    'errors' => $validator->errors(),
                    'old' => $request->all()
                ], 422);
            }

            // Validated data
            $validatedData = $validator->validated();

            // attempt to update marketing campaign type
            $data = $this->marketingCampaignTypeService->updateMarketingCampaignType($validatedData, $id);
            // Redirect based on the result
            if ($data) {
                if (is_array($data) && $data['status'] == 0) {
                    return response()->json([
                        'alertClass' => 'error',
                        'message' => $data['message']
                    ]);
                }
                return response()->json([
                    'alertClass' => 'success',
                    'message' => 'Marketing campaign type updated successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error in updating marketing campaign type.',
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
        $this->marketingCampaignTypeService->deleteMarketingCampaignType($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Marketing campaign type has been deleted successfully!'
        ], 200);
    }
}
