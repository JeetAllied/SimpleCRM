<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company_name',
        'industry',
        'address',
        'assigned_to',
    ];

    //relationship
    public function user(){
        return $this->belongsTo(User::class,'assigned_to','id');
    }
    /**
     * Service methods for CRUD
     */


    public function getAllCustomers()
    {
        return $this->with('user')->where('status',1)->orderBy('id','desc');
    }

    public function addCustomer($data)
    {
        return $this->create($data);
    }

    public function getCustomerById($id)
    {
        return $this->where('id',$id)->firstOrFail();
    }

    public function updateCustomer($data, $id)
    {
        return $this->where('id',$id)->update($data);
    }

    public function deleteCustomer($id)
    {
        return $this->where('id',$id)->update(['status'=> 0]);
    }

    public function getTotalActiveCustomers()
    {
        return $this->select('id')->where('status',1)->get()->count();
    }
    public function getAllCustomersData()
    {
        return $this->with('user')->where('status',1)->orderBy('id','desc')->get();
    }
}
