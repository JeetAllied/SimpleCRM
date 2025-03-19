<?php

namespace App\Http\Controllers;

use App\Services\LeadService\LeadService;
use App\Services\OpportunityService\OpportunityService;
use App\Services\OpportunityStageService\OpportunityStageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OpportunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $opportunityService,$leadService,$opportunityStageService;
    public function __construct(OpportunityService $opportunityService, LeadService $leadService, OpportunityStageService $opportunityStageService)
    {
        $this->opportunityService = $opportunityService;
        $this->leadService = $leadService;
        $this->opportunityStageService = $opportunityStageService;
    }
    public function index()
    {
        return view('opportunity.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $leads = $this->leadService->getAllLeadsData();
        $opportunityStages = $this->opportunityStageService->getAllOpportunityStages();
        return view('opportunity.modal.create',compact('leads','opportunityStages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'opportunity_name'=>'required',
                'lead_id' => 'required',
                'expected_value' => 'required|numeric|gt:0|regex:/^\d+(\.\d{1,2})?$/',
                'opportunity_stage_id' => 'required',
                'expected_close_date'=>'required',
            ];
            $messages = [
                'opportunity_name.required'=>'Please enter opportunity name.',
                'lead_id.required'=> 'Please select lead.',
                'expected_value.required'=> 'Please enter expected value.',
                'expected_value.numeric' => 'Expected value must be numeric only.',
                'expected_value.gt'=> 'Please enter value greater than 0.',
                'expected_close_date.required'=> 'Please select expected close date.',
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
                'opportunity_name'=>$request->opportunity_name,
                'lead_id' => $request->lead_id,
                'expected_value' => $request->expected_value,
                'opportunity_stage_id' => $request->opportunity_stage_id,
                'expected_close_date' => $request->expected_close_date,
            ];
            //dd($data);
            $opportunity = $this->opportunityService->addOpportunity($data);

            // Redirect based on the result
            if ($opportunity) {
                if (is_array($opportunity) && $opportunity['status'] == 0) {
                    return response()->json([
                        'alertClass' => 'error',
                        'message' => $opportunity['message']
                    ]);
                }
                return response()->json([
                    'alertClass' => 'success',
                    'message' => 'Opportunity created successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error occurred in opportunity creation.',
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
        $leads = $this->leadService->getAllLeadsData();
        $opportunityStages = $this->opportunityStageService->getAllOpportunityStages();
        $opportunity = $this->opportunityService->getOpportunityById($id);
        return view('opportunity.modal.edit',compact('leads','opportunityStages','opportunity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $rules = [
                'opportunity_name'=>'required',
                'lead_id' => 'required',
                'expected_value' => 'required|numeric|gt:0|regex:/^\d+(\.\d{1,2})?$/',
                'opportunity_stage_id' => 'required',
                'expected_close_date'=>'required',
            ];

            $messages = [
                'opportunity_name.required'=>'Please enter opportunity name.',
                'lead_id.required'=> 'Please select lead.',
                'expected_value.required'=> 'Please enter expected value.',
                'expected_value.numeric' => 'Expected value must be numeric only.',
                'expected_value.gt'=> 'Please enter value greater than 0.',
                'expected_close_date.required'=> 'Please select expected close date.',

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
                'opportunity_name'=>$request->opportunity_name,
                'lead_id' => $request->lead_id,
                'expected_value' => $request->expected_value,
                'opportunity_stage_id' => $request->opportunity_stage_id,
                'expected_close_date' => $request->expected_close_date,
            ];

            $opportunity = $this->opportunityService->updateOpportunity($data, $id);

            // Redirect based on the result
            if ($opportunity) {
                if (is_array($opportunity) && $opportunity['status'] == 0) {
                    return response()->json([
                        'alertClass' => 'error',
                        'message' => $opportunity['message']
                    ]);
                }
                return response()->json([
                    'alertClass' => 'success',
                    'message' => 'Opportunity updated successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error occurred in updating opportunity.',
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
        $this->opportunityService->deleteOpportunity($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Opportunity has been deleted successfully!',
        ], 200);
    }

    public function getAllOpportunities()
    {
        try{
            return $this->opportunityService->getAllOpportunities();
        }
        catch(\Exception $e)
        {

        }
    }
}
