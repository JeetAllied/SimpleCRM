<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    use HasFactory;
    protected $fillable = [
        'activity_type_name'
    ];

    /**
     * Service methods for CRUD
     */


    public function getAllActivityTypes()
    {
        return $this->select('id', 'activity_type_name','status')->where('status',1)->orderBy('id','desc')->get();
    }

    public function addActivityType($data)
    {
        return $this->create($data);
    }

    public function getActivityTypeById($id)
    {
        return $this->where('id',$id)->firstOrFail();
    }

    public function updateActivityType($data, $id)
    {
        return $this->where('id',$id)->update($data);
    }

    public function deleteActivityType($id)
    {
        return $this->where('id',$id)->update(['status'=> 0]);
    }

    public function getTotalActiveActivityTypes()
    {
        return $this->select('id')->where('status',1)->get()->count();
    }
}
