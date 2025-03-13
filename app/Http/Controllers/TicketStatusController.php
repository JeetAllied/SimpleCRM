<?php

namespace App\Http\Controllers;

use App\Services\TicketStatusService\TicketStatusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $ticketStatusService;
    public function __construct(TicketStatusService $ticketStatusService){
        $this->ticketStatusService = $ticketStatusService;
    }
    public function index()
    {
        $ticketStatuses = $this->ticketStatusService->getAllTicketStatuses();
        return view('ticket_status.index',compact('ticketStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ticket_status.modal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'ticket_status_name'=> 'required',
            ];

            $messages = [
                'ticket_status_name.required'=> 'Please enter ticket status.',
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

            //attempt to add the ticket status
            $data = $this->ticketStatusService->addTicketStatus($validatedData);

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
                    'message' => 'Ticket status created successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error occurred in ticket status creation.'
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
        $ticketStatus = $this->ticketStatusService->getTicketStatusById($id);
        return view('ticket_status.modal.edit',compact('ticketStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $rules = [
                'ticket_status_name'=>'required'
            ];
            $messages = [
                'ticket_status_name.required'=>'Please enter ticket status.',
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

            // attempt to update ticket status
            $data = $this->ticketStatusService->updateTicketStatus($validatedData, $id);
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
                    'message' => 'Ticket status updated successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error in updating ticket status.',
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
        $this->ticketStatusService->deleteTicketStatus($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Ticket status has been deleted successfully!'
        ], 200);
    }
}
