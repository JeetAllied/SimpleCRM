<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'activity_name',
        'user_id',
        'activity_type_id',
        'activity_detail'
    ];

    //relationships
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function activityType()
    {
        return $this->belongsTo(ActivityType::class,'activity_type_id','id');
    }

    /**
     * Service methods for CRUD
     */


    public function getAllActivities()
    {
        return $this->with(['user','activityType'])->where('activities.status',1)->orderBy('activities.id','desc');
    }

    public function addActivity($data)
    {
        return $this->create($data);
    }

    public function getActivityById($id)
    {
        return $this->where('id',$id)->firstOrFail();
    }

    public function updateActivity($data, $id)
    {
        return $this->where('id',$id)->update($data);
    }

    public function deleteActivity($id)
    {
        return $this->where('id',$id)->update(['status'=> 0]);
    }

    public function getTotalActiveActivities()
    {
        return $this->select('id')->where('status',1)->get()->count();
    }
}
