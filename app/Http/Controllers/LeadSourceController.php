<?php

namespace App\Http\Controllers;

use App\Services\LeadSourceService\LeadSourceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadSourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $leadSourceService;
    public function __construct(LeadSourceService $leadSourceService)
    {
        $this->leadSourceService = $leadSourceService;
    }
    public function index()
    {
        $leadSources = $this->leadSourceService->getAllLeadSources();
        return view('lead_source.index',compact('leadSources'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lead_source.modal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'lead_source_name'=> 'required',
            ];

            $messages = [
                'lead_source_name.required'=> 'Please enter lead source name.',
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

            //attempt to add the lead source
            $data = $this->leadSourceService->addLeadSource($validatedData);

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
                    'message' => 'Lead Source created successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error occurred in lead source creation.'
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
        $leadSource = $this->leadSourceService->getLeadSourceById($id);
        return view('lead_source.modal.edit',compact('leadSource'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $rules = [
                'lead_source_name'=>'required'
            ];
            $messages = [
                'lead_source_name.required'=>'Please enter lead source name.',
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

            // attempt to update lead source
            $data = $this->leadSourceService->updateLeadSource($validatedData, $id);
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
                    'message' => 'Lead Source updated successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error in updating lead source.',
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
        $this->leadSourceService->deleteLeadSource($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Lead Source has been deleted successfully!'
        ], 200);
    }
}
