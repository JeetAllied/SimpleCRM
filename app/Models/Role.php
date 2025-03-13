<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends \Spatie\Permission\Models\Role
{
    use HasFactory;

    /**
     * Service methods for CRUD
     */


    public function getAllRoles()
    {
        return $this->select('id', 'name')->where('status','=',1)->get();
    }

    public function addRole($data)
    {
        return $this->create($data);
    }

    public function findRoleById($id)
    {
        return $this->where('id', $id)->first();
    }

    public function updateRole($data, $id)
    {
        return $this->where('id', $id)->update($data);
    }

    public function deleteRole($id)
    {
        //return $this->find($id)->delete();
        return $this->where('id',$id)->update(['status'=> 0]);
    }
}
