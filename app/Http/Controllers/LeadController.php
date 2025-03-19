<?php

namespace App\Http\Controllers;

use App\Services\CustomerService\CustomerService;
use App\Services\LeadService\LeadService;
use App\Services\LeadSourceService\LeadSourceService;
use App\Services\LeadStatusService\LeadStatusService;
use App\Services\UserService\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $leadService,$customerService,$leadSourceService,$leadStatusService,$userService;
    public function __construct(LeadService $leadService, CustomerService $customerService, LeadSourceService $leadSourceService, LeadStatusService $leadStatusService, UserService $userService){
        $this->leadService = $leadService;
        $this->customerService = $customerService;
        $this->leadSourceService = $leadSourceService;
        $this->leadStatusService = $leadStatusService;
        $this->userService = $userService;
    }
    public function index()
    {
        return view('lead.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = $this->customerService->getAllCustomersData();
        $leadSources = $this->leadSourceService->getAllLeadSources();
        $leadStatuses = $this->leadStatusService->getAllLeadStatuses();
        $users = $this->userService->getAllUsers();
        return view('lead.modal.create',compact('customers','leadSources','leadStatuses','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'lead_title'=> 'required',
                'customer_id' => 'required',
                'lead_source_id' => 'required',
                'lead_status_id' => 'required',
                'assigned_to'=>'required',
            ];
            $messages = [
                'lead_title.required'=> 'Please enter lead title.',
                'customer_id.required'=> 'Please select customer.',
                'lead_source_id.required'=> 'Please select lead source.',
                'lead_status_id.required' => 'Please select lead status.',
                'assigned_to.required'=> 'Please select user to assign to lead.',
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
                'lead_title'=> $request->lead_title,
                'customer_id' => $request->customer_id,
                'lead_source_id' => $request->lead_source_id,
                'lead_status_id' => $request->lead_status_id,
                'assigned_to' => (int)$request->assigned_to,
            ];
            //dd($data);
            $lead = $this->leadService->addLead($data);

            // Redirect based on the result
            if ($lead) {
                if (is_array($lead) && $lead['status'] == 0) {
                    return response()->json([
                        'alertClass' => 'error',
                        'message' => $lead['message']
                    ]);
                }
                return response()->json([
                    'alertClass' => 'success',
                    'message' => 'Lead created successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error occurred in lead creation.',
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
        $customers = $this->customerService->getAllCustomersData();
        $leadSources = $this->leadSourceService->getAllLeadSources();
        $leadStatuses = $this->leadStatusService->getAllLeadStatuses();
        $users = $this->userService->getAllUsers();
        $lead = $this->leadService->getLeadById($id);
        return view('lead.modal.edit',compact('customers','leadSources','leadStatuses','users','lead'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $rules = [
                'lead_title'=> 'required',
                'customer_id' => 'required',
                'lead_source_id' => 'required',
                'lead_status_id' => 'required',
                'assigned_to'=>'required',
            ];

            $messages = [
                'lead_title.required'=> 'Please enter lead title.',
                'customer_id.required'=> 'Please select customer.',
                'lead_source_id.required'=> 'Please select lead source.',
                'lead_status_id.required' => 'Please select lead status.',
                'assigned_to.required'=> 'Please select user to assign to lead.',
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
                'lead_title'=> $request->lead_title,
                'customer_id' => $request->customer_id,
                'lead_source_id' => $request->lead_source_id,
                'lead_status_id' => $request->lead_status_id,
                'assigned_to' => (int)$request->assigned_to,
            ];


            $lead = $this->leadService->updateLead($data, $id);

            // Redirect based on the result
            if ($lead) {
                if (is_array($lead) && $lead['status'] == 0) {
                    return response()->json([
                        'alertClass' => 'error',
                        'message' => $lead['message']
                    ]);
                }
                return response()->json([
                    'alertClass' => 'success',
                    'message' => 'Lead updated successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error occurred in updating lead.',
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
        $this->leadService->deleteLead($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Lead has been deleted successfully!',
        ], 200);
    }

    public function getAllLeads()
    {
        try{
            return $this->leadService->getAllLeads();
        }
        catch(\Exception $e)
        {

        }
    }
}
