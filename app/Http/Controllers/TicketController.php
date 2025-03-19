<?php

namespace App\Http\Controllers;

use App\Services\CustomerService\CustomerService;
use App\Services\TicketService\TicketService;
use App\Services\TicketStatusService\TicketStatusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $ticketService,$customerService,$ticketStatusService;
    public function __construct(TicketService $ticketService, CustomerService $customerService, TicketStatusService $ticketStatusService)
    {
        $this->ticketService = $ticketService;
        $this->customerService = $customerService;
        $this->ticketStatusService = $ticketStatusService;
    }
    public function index()
    {
        return view('ticket.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = $this->customerService->getAllCustomersData();
        $ticketStatuses = $this->ticketStatusService->getAllTicketStatuses();
        return view('ticket.modal.create',compact('customers','ticketStatuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'customer_id'=>'required',
                'subject' => 'required',
                'description' => 'required',
                'ticket_status_id' => 'required',
            ];
            $messages = [
                'customer_id.required'=>'Please select customer.',
                'subject.required'=> 'Please enter subject.',
                'description.required'=> 'Please enter description.',
                'ticket_status_id.required'=>'Please select ticket status.',

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
                'customer_id'=>$request->customer_id,
                'subject' => $request->subject,
                'description' => $request->description,
                'ticket_status_id' => $request->ticket_status_id,
            ];

            $ticket = $this->ticketService->addTicket($data);

            // Redirect based on the result
            if ($ticket) {
                if (is_array($ticket) && $ticket['status'] == 0) {
                    return response()->json([
                        'alertClass' => 'error',
                        'message' => $ticket['message']
                    ]);
                }
                return response()->json([
                    'alertClass' => 'success',
                    'message' => 'Ticket created successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error occurred in ticket creation.',
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
        $ticketStatuses = $this->ticketStatusService->getAllTicketStatuses();
        $ticket = $this->ticketService->getTicketById($id);
        return view('ticket.modal.edit',compact('customers','ticketStatuses','ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        try {

            $rules = [
                'customer_id'=>'required',
                'subject' => 'required',
                'description' => 'required',
                'ticket_status_id' => 'required',
            ];

            $messages = [
                'customer_id.required'=>'Please select customer.',
                'subject.required'=> 'Please enter subject.',
                'description.required'=> 'Please enter description.',
                'ticket_status_id.required'=>'Please select ticket status.',

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
                'customer_id'=>$request->customer_id,
                'subject' => $request->subject,
                'description' => $request->description,
                'ticket_status_id' => $request->ticket_status_id,
            ];

            $ticket = $this->ticketService->updateTicket($data, $id);

            // Redirect based on the result
            if ($ticket) {
                if (is_array($ticket) && $ticket['status'] == 0) {
                    return response()->json([
                        'alertClass' => 'error',
                        'message' => $ticket['message']
                    ]);
                }
                return response()->json([
                    'alertClass' => 'success',
                    'message' => 'Ticket updated successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error occurred in updating ticket.',
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
        $this->ticketService->deleteTicket($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Ticket has been deleted successfully!',
        ], 200);
    }

    public function getAllTickets()
    {
        try{
            return $this->ticketService->getAllTickets();
        }
        catch(\Exception $e)
        {

        }
    }
}
