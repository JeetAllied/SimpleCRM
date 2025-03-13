<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadStatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'lead_status_name'
    ];

    /**
     * Service methods for CRUD
     */


    public function getAllLeadStatuses()
    {
        return $this->select('id', 'lead_status_name','status')->where('status',1)->orderBy('id','desc')->get();
    }

    public function addLeadStatus($data)
    {
        return $this->create($data);
    }

    public function getLeadStatusById($id)
    {
        return $this->where('id',$id)->firstOrFail();
    }

    public function updateLeadStatus($data, $id)
    {
        return $this->where('id',$id)->update($data);
    }

    public function deleteLeadStatus($id)
    {
        return $this->where('id',$id)->update(['status'=> 0]);
    }

    public function getTotalActiveLeadStatuses()
    {
        return $this->select('id')->where('status',1)->get()->count();
    }
}
