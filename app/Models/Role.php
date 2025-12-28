<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class Role extends Model
{
    //

    protected $fillable = ['name', 'description'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_has_permission', 'role_id', 'permission_id');
    }

    public function assignPermission(Permission $permission)
    {
        return $this->permissions()->attach($permission);
    }

    public function user(){
        return $this->belongsToMany(User::class, 'user_has_role', 'role_id', 'user_id');
    }

    public function hasPermission($permissionName){
        return $this->permissions()->where('name', $permissionName)->exists();
    }
}
