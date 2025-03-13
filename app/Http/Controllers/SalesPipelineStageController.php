<?php

namespace App\Http\Controllers;

use App\Services\SalesPipelineStageService\SalesPipelineStageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalesPipelineStageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $salesPipelineStageService;
    public function __construct(SalesPipelineStageService $salesPipelineStageService){
        $this->salesPipelineStageService = $salesPipelineStageService;
    }
    public function index()
    {
        $salesPipelineStages = $this->salesPipelineStageService->getAllSalesPipelineStages();
        return view('sales_pipeline_stage.index',compact('salesPipelineStages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sales_pipeline_stage.modal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'sales_pipeline_stage_name'=> 'required',
            ];

            $messages = [
                'sales_pipeline_stage_name.required'=> 'Please enter sales pipeline stage.',
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

            //attempt to add the sales pipeline stage
            $data = $this->salesPipelineStageService->addSalesPipelineStage($validatedData);

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
                    'message' => 'Sales pipeline stage created successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error occurred in sales pipeline stage creation.'
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
        $salesPipelineStage = $this->salesPipelineStageService->getSalesPipelineStageById($id);
        return view('sales_pipeline_stage.modal.edit',compact('salesPipelineStage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $rules = [
                'sales_pipeline_stage_name'=>'required'
            ];
            $messages = [
                'sales_pipeline_stage_name.required'=>'Please enter sales pipeline stage.',
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

            // attempt to update sales pipeline stage
            $data = $this->salesPipelineStageService->updateSalesPipelineStage($validatedData, $id);
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
                    'message' => 'Sales pipeline stage updated successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error in updating sales pipeline stage.',
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
        $this->salesPipelineStageService->deleteSalesPipelineStage($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Sales pipeline stage has been deleted successfully!'
        ], 200);
    }
}
