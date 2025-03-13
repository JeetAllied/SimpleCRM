<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadSource extends Model
{
    use HasFactory;
    protected $fillable = [
        'lead_source_name'
    ];

    /**
     * Service methods for CRUD
     */


    public function getAllLeadSources()
    {
        return $this->select('id', 'lead_source_name','status')->where('status',1)->orderBy('id','desc')->get();
    }

    public function addLeadSource($data)
    {
        return $this->create($data);
    }

    public function getLeadSourceById($id)
    {
        return $this->where('id',$id)->firstOrFail();
    }

    public function updateLeadSource($data, $id)
    {
        return $this->where('id',$id)->update($data);
    }

    public function deleteLeadSource($id)
    {
        return $this->where('id',$id)->update(['status'=> 0]);
    }

    public function getTotalActiveLeadSources()
    {
        return $this->select('id')->where('status',1)->get()->count();
    }
}
