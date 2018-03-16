<?php


namespace App\Permissions;

use App\Models\Permission;
use App\Models\Role;

trait HasPermissionsTrait
{
    /**
     * Give permissions to the user
     * @param array ...$permissions
     * @return $this
     */
    public function givePermissionTo(...$permissions)
    {
        // get permission models
        $permissions = $this->getAllPermissions(array_flatten($permissions));

        if($permissions === null) {
            return $this;
        }

        $this->permissions()->saveMany($permissions);
        return $this;
    }

    /**
     * Withdraw permissions from user
     * @param array ...$permissions
     * @return $this
     */
    public function withdrawPermissionTo(...$permissions)
    {
        // get permission models
        $permissions = $this->getAllPermissions(array_flatten($permissions));

        $this->permissions()->detach($permissions);
        return $this;
    }


    public function updatePermissions(...$permissions)
    {
        $this->permissions()->detach();

        return $this->givePermissionTo($permissions);
    }


    public function hasRole(...$roles)
    {
        foreach ($roles as $role){
            if($this->roles->contains('name', $role)){
                return true;
            }
        }
        return false;
    }


    public function hasPermissionTo($permission)
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    // checks a specific user role has some specific permissions
    protected function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role){
            if($this->roles->contains($role))
            {
                print_r($role);
                return true;
            }
        }
        return false;
    }


    protected function hasPermission($permission)
    {
        return (bool) $this->permissions->where('name',$permission->name)->count();
    }

    protected function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('name', $permissions)->get();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }
}