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

        \DB::table('roles')->delete();
        \DB::table('users')->delete();
        \DB::table('type_links')->delete();
        \DB::table('following_links')->delete();

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
