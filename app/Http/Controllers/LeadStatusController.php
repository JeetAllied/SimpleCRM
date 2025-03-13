<?php

namespace App\Http\Controllers;

use App\Services\LeadStatusService\LeadStatusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $leadStatusService;
    public function __construct(LeadStatusService $leadStatusService)
    {
        $this->leadStatusService = $leadStatusService;
    }
    public function index()
    {
        $leadStatuses = $this->leadStatusService->getAllLeadStatuses();
        return view('lead_status.index', compact('leadStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lead_status.modal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'lead_status_name'=> 'required',
            ];

            $messages = [
                'lead_status_name.required'=> 'Please enter lead status.',
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

            //attempt to add the lead status
            $data = $this->leadStatusService->addLeadStatus($validatedData);

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
                    'message' => 'Lead Status created successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error occurred in lead status creation.'
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
        $leadStatus = $this->leadStatusService->getLeadStatusById($id);
        return view('lead_status.modal.edit',compact('leadStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $rules = [
                'lead_status_name'=>'required'
            ];
            $messages = [
                'lead_status_name.required'=>'Please enter lead status.',
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

            // attempt to update lead status
            $data = $this->leadStatusService->updateLeadStatus($validatedData, $id);
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
                    'message' => 'Lead Status updated successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error in updating lead status.',
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
        $this->leadStatusService->deleteLeadStatus($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Lead Status has been deleted successfully!'
        ], 200);
    }
}
