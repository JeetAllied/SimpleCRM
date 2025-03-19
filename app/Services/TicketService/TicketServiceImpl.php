<?php
namespace App\Services\TicketService;
use App\Models\Ticket;
use Yajra\DataTables\Facades\DataTables;

class TicketServiceImpl implements TicketService
{
    private $ticket;
    public function __construct()
    {
        $this->ticket = new Ticket();
    }
    public function getAllTickets()
    {

        $user = auth()->user();
        $resultData = $this->ticket->getAllTickets();

        return DataTables::of($resultData)
            ->addColumn('action', function ($result) use($user) {

                $html = '';
                /*if($user->can('manage_service_order'))
                {
                    $html .= '<a href="'.route('service-orders.show',$result->id).'" class="btn btn-primary mb-1" title="View Service Order"><i class="bi bi-eye"></i> </a>';
                }
                if($user->can('update_service_order'))
                {*/
                if($result->status == 1){
                    $html .= '<button type="button" data-remote="'.route('tickets.edit',$result->id).'" class="btn btn-sm btn-warning" title="Edit Ticket" data-request="ajaxModal" data-reload="true"><i class="fas fa-pen"></i> </button>';
                }
                /*}
                if($user->can('delete_service_order'))
                {*/
                if($result->status == 1) {
                    $html .= '<a href="javascript:void(0)" class="btn btn-sm btn-danger delete-data ml-2" data-url="' . route('tickets.destroy', $result->id) . '" id="' . $result->id . '" title="Delete Ticket"><i class="fas fa-trash"></i></a>';
                }
                //}

                return $html;
            })
            ->editColumn('created_at', function ($result) {
                return $result->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('updated_at', function ($result) {
                return $result->updated_at->format('Y-m-d H:i:s');
            })
            ->editColumn('status', function ($result) {
                $statusText = "";
                if($result->status == 1)
                {
                    $statusText = '<span class="badge rounded-pill bg-primary text-light">Active</span>';
                }
                else
                {
                    $statusText = '<span class="badge rounded-pill bg-warning text-dark">In-Active</span>';
                }
                return $statusText;
            })
            ->filterColumn('status', function ($query, $keyword) {
                $query->where('status', $keyword);
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function addTicket($data)
    {
        return $this->ticket->addTicket($data);
    }

    public function getTicketById($id)
    {
        return $this->ticket->getTicketById($id);
    }

    public function updateTicket($data, $id)
    {
        return $this->ticket->updateTicket($data, $id);
    }

    public function deleteTicket($id)
    {
        return $this->ticket->deleteTicket($id);
    }

    public function getTotalActiveTickets()
    {
        return $this->ticket->getTotalActiveTickets();
    }
}
