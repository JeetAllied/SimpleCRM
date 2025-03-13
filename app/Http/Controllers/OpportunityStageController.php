<?php

namespace App\Http\Controllers;

use App\Services\OpportunityStageService\OpportunityStageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OpportunityStageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $opportunityStageService;
    public function __construct(OpportunityStageService $opportunityStageService){
        $this->opportunityStageService = $opportunityStageService;
    }
    public function index()
    {
        $opportunityStages = $this->opportunityStageService->getAllOpportunityStages();
        return view('opportunity_stage.index',compact('opportunityStages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('opportunity_stage.modal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'opportunity_stage_name'=> 'required',
            ];

            $messages = [
                'opportunity_stage_name.required'=> 'Please enter opportunity stage.',
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

            //attempt to add the opportunity stage
            $data = $this->opportunityStageService->addOpportunityStage($validatedData);

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
                    'message' => 'Opportunity stage created successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error occurred in opportunity stage creation.'
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
        $opportunityStage = $this->opportunityStageService->getOpportunityStageById($id);
        return view('opportunity_stage.modal.edit',compact('opportunityStage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $rules = [
                'opportunity_stage_name'=>'required'
            ];
            $messages = [
                'opportunity_stage_name.required'=>'Please enter opportunity stage.',
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

            // attempt to update opportunity stage
            $data = $this->opportunityStageService->updateOpportunityStage($validatedData, $id);
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
                    'message' => 'Opportunity stage updated successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error in updating opportunity stage.',
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
        $this->opportunityStageService->deleteOpportunityStage($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Opportunity stage has been deleted successfully!'
        ], 200);
    }
}
