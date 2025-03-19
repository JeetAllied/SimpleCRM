<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesPipeline extends Model
{
    protected $fillable = [
        'title',
        'opportunity_id',
        'sales_pipeline_stage_id',
        'probability'
    ];

    //relationships
    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class,'opportunity_id','id');
    }

    public function salesPipelineStage()
    {
        return $this->belongsTo(SalesPipelineStage::class,'sales_pipeline_stage_id','id');
    }

    /**
     * Service methods for CRUD
     */


    public function getAllSalesPipelines()
    {
        return $this->with(['opportunity','salesPipelineStage'])->where('sales_pipelines.status',1)->orderBy('sales_pipelines.id','desc');
    }

    public function addSalesPipeline($data)
    {
        return $this->create($data);
    }

    public function getSalesPipelineById($id)
    {
        return $this->where('id',$id)->firstOrFail();
    }

    public function updateSalesPipeline($data, $id)
    {
        return $this->where('id',$id)->update($data);
    }

    public function deleteSalesPipeline($id)
    {
        return $this->where('id',$id)->update(['status'=> 0]);
    }

    public function getTotalActiveSalesPipelines()
    {
        return $this->select('id')->where('status',1)->get()->count();
    }
}
