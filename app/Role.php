<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    
    /**
     * Database table name
     * 
     * @var type 
     */
    protected $table = 'roles';
    
    /**
     * The relationship(One To Many) to User model
     * 
     * @return type
     */
    public function users()
    {
        return $this->hasMany('App\User','role_id', 'id');
    }
}
