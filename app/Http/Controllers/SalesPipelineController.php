<?php

namespace App\Http\Controllers;

use App\Services\OpportunityService\OpportunityService;
use App\Services\SalesPipelineService\SalesPipelineService;
use App\Services\SalesPipelineStageService\SalesPipelineStageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalesPipelineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $salesPipelineService,$opportunityService,$salesPipelineStageService;
    public function __construct(SalesPipelineService $salesPipelineService, OpportunityService $opportunityService, SalesPipelineStageService $salesPipelineStageService)
    {
        $this->salesPipelineService = $salesPipelineService;
        $this->opportunityService = $opportunityService;
        $this->salesPipelineStageService = $salesPipelineStageService;
    }
    public function index()
    {
        return view('sales_pipeline.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $opportunities = $this->opportunityService->getAllOpportunitiesData();
        $salesPipelineStages = $this->salesPipelineStageService->getAllSalesPipelineStages();
        return view('sales_pipeline.modal.create',compact('opportunities','salesPipelineStages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'title'=>'required',
                'opportunity_id' => 'required',
                'sales_pipeline_stage_id' => 'required',
                'probability' => 'required|numeric|gt:0|regex:/^\d+(\.\d{1,2})?$/',
            ];
            $messages = [
                'title.required'=>'Please enter sales pipeline title.',
                'opportunity_id.required'=> 'Please select opportunity.',
                'sales_pipeline_stage_id.required'=> 'Please select sales pipeline stage.',
                'probability.required'=>'Please enter probability value.',
                'probability.numeric' => 'Probability value must be numeric only.',
                'probability.gt'=> 'Please enter value greater than 0.',
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
                'title'=>$request->title,
                'opportunity_id' => $request->opportunity_id,
                'sales_pipeline_stage_id' => $request->sales_pipeline_stage_id,
                'probability' => $request->probability,
            ];

            $salesPipeline = $this->salesPipelineService->addSalesPipeline($data);

            // Redirect based on the result
            if ($salesPipeline) {
                if (is_array($salesPipeline) && $salesPipeline['status'] == 0) {
                    return response()->json([
                        'alertClass' => 'error',
                        'message' => $salesPipeline['message']
                    ]);
                }
                return response()->json([
                    'alertClass' => 'success',
                    'message' => 'Sales pipeline created successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error occurred in sales pipeline creation.',
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
        $opportunities = $this->opportunityService->getAllOpportunitiesData();
        $salesPipelineStages = $this->salesPipelineStageService->getAllSalesPipelineStages();
        $salesPipeline = $this->salesPipelineService->getSalesPipelineById($id);
        return view('sales_pipeline.modal.edit',compact('opportunities','salesPipelineStages','salesPipeline'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $rules = [
                'title'=>'required',
                'opportunity_id' => 'required',
                'sales_pipeline_stage_id' => 'required',
                'probability' => 'required|numeric|gt:0|regex:/^\d+(\.\d{1,2})?$/',
            ];

            $messages = [
                'title.required'=>'Please enter sales pipeline title.',
                'opportunity_id.required'=> 'Please select opportunity.',
                'sales_pipeline_stage_id.required'=> 'Please select sales pipeline stage.',
                'probability.required'=>'Please enter probability value.',
                'probability.numeric' => 'Probability value must be numeric only.',
                'probability.gt'=> 'Please enter value greater than 0.',

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
                'title'=>$request->title,
                'opportunity_id' => $request->opportunity_id,
                'sales_pipeline_stage_id' => $request->sales_pipeline_stage_id,
                'probability' => $request->probability,
            ];

            $salesPipeline = $this->salesPipelineService->updateSalesPipeline($data, $id);

            // Redirect based on the result
            if ($salesPipeline) {
                if (is_array($salesPipeline) && $salesPipeline['status'] == 0) {
                    return response()->json([
                        'alertClass' => 'error',
                        'message' => $salesPipeline['message']
                    ]);
                }
                return response()->json([
                    'alertClass' => 'success',
                    'message' => 'Sales pipeline updated successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error occurred in updating sales pipeline.',
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
        $this->salesPipelineService->deleteSalesPipeline($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Sales pipeline has been deleted successfully!',
        ], 200);
    }

    public function getAllSalesPipelines()
    {
        try{
            return $this->salesPipelineService->getAllSalesPipelines();
        }
        catch(\Exception $e)
        {

        }
    }
}
