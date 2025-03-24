<?php
namespace App\Services\MarketingCampaignService;
use App\Models\MarketingCampaign;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class MarketingCampaignServiceImpl implements MarketingCampaignService
{
    private $marketingCampaign;
    public function __construct()
    {
        $this->marketingCampaign = new MarketingCampaign();
    }
    public function getAllMarketingCampaigns()
    {
        $user = auth()->user();
        $resultData = $this->marketingCampaign->getAllMarketingCampaigns();

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
                    $html .= '<button type="button" data-remote="'.route('marketing-campaigns.edit',$result->id).'" class="btn btn-sm btn-warning" title="Edit Marketing Campaign" data-request="ajaxModal" data-reload="true"><i class="fas fa-pen"></i> </button>';
                }
                /*}
                if($user->can('delete_service_order'))
                {*/
                if($result->status == 1) {
                    $html .= '<a href="javascript:void(0)" class="btn btn-sm btn-danger delete-data ml-2" data-url="' . route('marketing-campaigns.destroy', $result->id) . '" id="' . $result->id . '" title="Delete Marketing Campaign"><i class="fas fa-trash"></i></a>';
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
            ->editColumn('start_date', function ($result) {
                $startDate = new Carbon($result->start_date);
                //return $result->start_date->format('d-M-Y');
                return $startDate->format('d-M-Y');
            })
            ->editColumn('end_date', function ($result) {
                $endDate = new Carbon($result->end_date);
                //return $result->end_date->format('d-M-Y');
                return $endDate->format('d-M-Y');
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

    public function addMarketingCampaign($data)
    {
        return $this->marketingCampaign->addMarketingCampaign($data);
    }

    public function getMarketingCampaignById($id)
    {
        return $this->marketingCampaign->getMarketingCampaignById($id);
    }

    public function updateMarketingCampaign($data, $id)
    {
        return $this->marketingCampaign->updateMarketingCampaign($data, $id);
    }

    public function deleteMarketingCampaign($id)
    {
        return $this->marketingCampaign->deleteMarketingCampaign($id);
    }

    public function getTotalMarketingCampaigns()
    {
        return $this->marketingCampaign->getTotalMarketingCampaigns();
    }
}
