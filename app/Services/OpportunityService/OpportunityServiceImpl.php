<?php
namespace App\Services\OpportunityService;
use App\Models\Opportunity;
use Yajra\DataTables\Facades\DataTables;

class OpportunityServiceImpl implements OpportunityService
{
    private $opportunity;
    public function __construct(){
        $this->opportunity = new Opportunity();
    }
    public function getAllOpportunities()
    {
        $user = auth()->user();
        $resultData = $this->opportunity->getAllOpportunities();

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
                    $html .= '<button type="button" data-remote="'.route('opportunities.edit',$result->id).'" class="btn btn-sm btn-warning" title="Edit Opportunity" data-request="ajaxModal" data-reload="true"><i class="fas fa-pen"></i> </button>';
                }
                /*}
                if($user->can('delete_service_order'))
                {*/
                if($result->status == 1) {
                    $html .= '<a href="javascript:void(0)" class="btn btn-sm btn-danger delete-data ml-2" data-url="' . route('opportunities.destroy', $result->id) . '" id="' . $result->id . '" title="Delete Opportunity"><i class="fas fa-trash"></i></a>';
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
            ->editColumn('expected_close_date', function ($result) {
                return $result->updated_at->format('d-M-Y ');
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

    public function addOpportunity($data)
    {
        return $this->opportunity->addOpportunity($data);
    }

    public function getOpportunityById($id)
    {
        return $this->opportunity->getOpportunityById($id);
    }

    public function updateOpportunity($data, $id)
    {
        return $this->opportunity->updateOpportunity($data,$id);
    }

    public function deleteOpportunity($id)
    {
        return $this->opportunity->deleteOpportunity($id);
    }

    public function getTotalActiveOpportunities()
    {
        return $this->opportunity->getTotalActiveOpportunities();
    }
    public function getAllOpportunitiesData()
    {
        return $this->opportunity->getAllOpportunitiesData();
    }
}
