<?php
namespace App\Services\LeadService;
use App\Models\Lead;
use Yajra\DataTables\Facades\DataTables;

class LeadServiceImpl implements LeadService{
    private $lead;
    public function __construct()
    {
        $this->lead = new Lead();
    }
    public function getAllLeads()
    {
        $user = auth()->user();
        $resultData = $this->lead->getAllLeads();
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
                    $html .= '<button type="button" data-remote="'.route('leads.edit',$result->id).'" class="btn btn-sm btn-warning" title="Edit Lead" data-request="ajaxModal" data-reload="true"><i class="fas fa-pen"></i> </button>';
                }
                /*}
                if($user->can('delete_service_order'))
                {*/
                if($result->status == 1) {
                    $html .= '<a href="javascript:void(0)" class="btn btn-sm btn-danger delete-data ml-2" data-url="' . route('leads.destroy', $result->id) . '" id="' . $result->id . '" title="Delete Lead"><i class="fas fa-trash"></i></a>';
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

    public function addLead($data)
    {
        return $this->lead->addLead($data);
    }

    public function getLeadById($id)
    {
        return $this->lead->getLeadById($id);
    }

    public function updateLead($data, $id)
    {
        return $this->lead->updateLead($data,$id);
    }

    public function deleteLead($id)
    {
        return $this->lead->deleteLead($id);
    }

    public function getTotalActiveLeads()
    {
        return $this->lead->getTotalActiveLeads();
    }

    public function getAllLeadsData()
    {
        return $this->lead->getAllLeadsData();
    }
}
