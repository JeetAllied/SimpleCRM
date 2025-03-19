<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'customer_id',
        'subject',
        'description',
        'ticket_status_id'
    ];

    //relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function ticketStatus()
    {
        return $this->belongsTo(TicketStatus::class,'ticket_status_id','id');
    }

    /**
     * Service methods for CRUD
     */


    public function getAllTickets()
    {
        return $this->with(['customer','ticketStatus'])->where('tickets.status',1)->orderBy('tickets.id','desc');
    }

    public function addTicket($data)
    {
        return $this->create($data);
    }

    public function getTicketById($id)
    {
        return $this->where('id',$id)->firstOrFail();
    }

    public function updateTicket($data, $id)
    {
        return $this->where('id',$id)->update($data);
    }

    public function deleteTicket($id)
    {
        return $this->where('id',$id)->update(['status'=> 0]);
    }

    public function getTotalActiveTickets()
    {
        return $this->select('id')->where('status',1)->get()->count();
    }
}
