<?php

namespace App\Http\Controllers\API\Traits;

trait Admin
{
    
    private function adminRoleId()
    {
        $role = \App\Role::where('role_name', '=', 'Admin')->first(['id']);
        return $role->id;
    }
    
}
