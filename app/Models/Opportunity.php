<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    protected $table = "opportunities";
    protected $fillable = [
        'lead_id',
        'expected_value',
        'opportunity_stage_id',
        'expected_close_date'
    ];

    //relationship


    public function lead(){
        return $this->belongsTo(Lead::class,'lead_id','id');
    }

    public function opportunityStage(){
        return $this->belongsTo(OpportunityStage::class,'opportunity_stage_id','id');
    }

    /**
     * Service methods for CRUD
     */


    public function getAllOpportunities()
    {
        return $this->with(['lead','opportunityStage'])->where('opportunity.status',1)->orderBy('opportunity.id','desc');
    }

    public function addOpportunity($data)
    {
        return $this->create($data);
    }

    public function getOpportunityById($id)
    {
        return $this->where('id',$id)->firstOrFail();
    }

    public function updateOpportunity($data, $id)
    {
        return $this->where('id',$id)->update($data);
    }

    public function deleteOpportunity($id)
    {
        return $this->where('id',$id)->update(['status'=> 0]);
    }

    public function getTotalActiveOpportunities()
    {
        return $this->select('id')->where('status',1)->get()->count();
    }
}
