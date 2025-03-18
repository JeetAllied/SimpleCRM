<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'customer_id',
        'lead_source_id',
        'lead_status_id',
        'assigned_to'
    ];

    //relationship
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function leadSource(){
        return $this->belongsTo(LeadSource::class,'lead_source_id','id');
    }

    public function leadStatus(){
        return $this->belongsTo(LeadStatus::class,'lead_status_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'assigned_to','id');
    }

    /**
     * Service methods for CRUD
     */


    public function getAllLeads()
    {
        return $this->with(['customer','leadSource','leadStatus','user'])->where('leads.status',1)->orderBy('leads.id','desc');
    }

    public function addLead($data)
    {
        return $this->create($data);
    }

    public function getLeadById($id)
    {
        return $this->where('id',$id)->firstOrFail();
    }

    public function updateLead($data, $id)
    {
        return $this->where('id',$id)->update($data);
    }

    public function deleteLead($id)
    {
        return $this->where('id',$id)->update(['status'=> 0]);
    }

    public function getTotalActiveLeads()
    {
        return $this->select('id')->where('status',1)->get()->count();
    }

    public function getAllLeadsData()
    {
        return $this->with(['customer','leadSource','leadStatus','user'])->where('leads.status',1)->orderBy('leads.id','desc')->get();
    }
}
