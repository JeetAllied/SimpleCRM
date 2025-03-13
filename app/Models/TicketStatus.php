<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_status_name'
    ];

    /**
     * Service methods for CRUD
     */


    public function getAllTicketStatuses()
    {
        return $this->select('id', 'ticket_status_name','status')->where('status',1)->orderBy('id','desc')->get();
    }

    public function addTicketStatus($data)
    {
        return $this->create($data);
    }

    public function getTicketStatusById($id)
    {
        return $this->where('id',$id)->firstOrFail();
    }

    public function updateTicketStatus($data, $id)
    {
        return $this->where('id',$id)->update($data);
    }

    public function deleteTicketStatus($id)
    {
        return $this->where('id',$id)->update(['status'=> 0]);
    }

    public function getTotalActiveTicketStatus()
    {
        return $this->select('id')->where('status',1)->get()->count();
    }
}
