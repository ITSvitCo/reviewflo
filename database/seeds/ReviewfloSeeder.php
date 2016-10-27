<?php

use Illuminate\Database\Seeder;

class ReviewfloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->deleteTables();
        $this->addRoles();
        $this->addUser();
        $this->addTypeLinks();
    }
    
    /**
     * Delete tabkle from database
     */
    private function deleteTables()
    {
        \DB::table('following_links')->delete();
        \DB::table('type_links')->delete();
        \DB::table('users')->delete();
        \DB::table('roles')->delete();
    }
    
    
    /**
     * Add roles for user
     */
    private function addRoles()
    {
        \DB::table('roles')->insert([
            [
               'role_name'=>'Admin'
            ],
            [
               'role_name'=>'Client'
            ],
            [
               'role_name'=>'Client Customer'
            ],
        ]);
    }
    
    /**
     * Add user with admin role
     */
    private function addUser()
    {
        $role = \DB::table('roles')->select('id')->where('role_name', '=', 'Admin')->first();
        \DB::table('users')->insert([
            [
                'role_id'=> $role->id,
                'name' =>'Alex',
                'email' => 'ak@itsvit.org',
                'password' =>  bcrypt('admin'),
                'active' => true,
            ],
           
        ]);
    }
    
    /**
     * Add type of clients link 
     */
    private function addTypeLinks()
    {
        \DB::table('type_links')->insert([
            [
                'type' => 'facebook'
            ],
            [
                'type' => 'google'
            ],
        ]);
    }
}
