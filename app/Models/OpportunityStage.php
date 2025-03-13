<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpportunityStage extends Model
{
    use HasFactory;
    protected $fillable = [
        'opportunity_stage_name'
    ];

    /**
     * Service methods for CRUD
     */


    public function getAllOpportunityStages()
    {
        return $this->select('id', 'opportunity_stage_name','status')->where('status',1)->orderBy('id','desc')->get();
    }

    public function addOpportunityStage($data)
    {
        return $this->create($data);
    }

    public function getOpportunityStageById($id)
    {
        return $this->where('id',$id)->firstOrFail();
    }

    public function updateOpportunityStage($data, $id)
    {
        return $this->where('id',$id)->update($data);
    }

    public function deleteOpportunityStage($id)
    {
        return $this->where('id',$id)->update(['status'=> 0]);
    }

    public function getTotalActiveOpportunityStages()
    {
        return $this->select('id')->where('status',1)->get()->count();
    }
}
