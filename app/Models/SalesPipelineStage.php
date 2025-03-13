<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesPipelineStage extends Model
{
    use HasFactory;
    protected $fillable = [
        'sales_pipeline_stage_name'
    ];

    /**
     * Service methods for CRUD
     */


    public function getAllSalesPipelineStages()
    {
        return $this->select('id', 'sales_pipeline_stage_name','status')->where('status',1)->orderBy('id','desc')->get();
    }

    public function addSalesPipelineStage($data)
    {
        return $this->create($data);
    }

    public function getSalesPipelineStageById($id)
    {
        return $this->where('id',$id)->firstOrFail();
    }

    public function updateSalesPipelineStage($data, $id)
    {
        return $this->where('id',$id)->update($data);
    }

    public function deleteSalesPipelineStage($id)
    {
        return $this->where('id',$id)->update(['status'=> 0]);
    }

    public function getTotalActiveSalesPipelineStage()
    {
        return $this->select('id')->where('status',1)->get()->count();
    }
}
