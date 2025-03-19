<?php
namespace App\Services\SalesPipelineService;


use App\Models\SalesPipeline;
use Yajra\DataTables\Facades\DataTables;

class SalesPipelineServiceImpl implements SalesPipelineService{
    private $salesPipeline;
    public function __construct()
    {
        $this->salesPipeline = new SalesPipeline();
    }
    public function getAllSalesPipelines()
    {

        $user = auth()->user();
        $resultData = $this->salesPipeline->getAllSalesPipelines();

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
                    $html .= '<button type="button" data-remote="'.route('sales-pipelines.edit',$result->id).'" class="btn btn-sm btn-warning" title="Edit Sales Pipeline" data-request="ajaxModal" data-reload="true"><i class="fas fa-pen"></i> </button>';
                }
                /*}
                if($user->can('delete_service_order'))
                {*/
                if($result->status == 1) {
                    $html .= '<a href="javascript:void(0)" class="btn btn-sm btn-danger delete-data ml-2" data-url="' . route('sales-pipelines.destroy', $result->id) . '" id="' . $result->id . '" title="Delete Sales Pipeline"><i class="fas fa-trash"></i></a>';
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

    public function addSalesPipeline($data)
    {
        return $this->salesPipeline->addSalesPipeline($data);
    }

    public function getSalesPipelineById($id)
    {
        return $this->salesPipeline->getSalesPipelineById($id);
    }

    public function updateSalesPipeline($data, $id)
    {
        return $this->salesPipeline->updateSalesPipeline($data, $id);
    }

    public function deleteSalesPipeline($id)
    {
        return $this->salesPipeline->deleteSalesPipeline($id);
    }

    public function getTotalActiveSalesPipelines()
    {
        return $this->salesPipeline->getTotalActiveSalesPipelines();
    }
}
