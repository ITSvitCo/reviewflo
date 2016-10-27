<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests\API\StoreAdminRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\Traits\Admin;

class AdminController extends Controller
{
    use Admin;
    /**
     * Show all admins
     *
     * Get a JSON representation of all the contacts
     *
     * @Get('/')
     */
    public function index()
    {
        $roleAdmin = \App\Role::where('role_name', 'Admin')->with('users')->first();
        return json_encode($roleAdmin->users)  ;
    }

    /**
     * Store a new admin in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        try{
            $newAdmin = [
                'role_id' => $this->adminRoleId(),
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'active' => true,
            ];
            $user = \App\User::create($newAdmin);
            $message = 'admin created';
            $error = 0;        
        }catch(\Exception $e){
            $error = 1;
            $message = $e->getMessage();
        }
        return ['error' => $error, 'message' => $message];
    }

    /**
     * Display the admin.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Update the admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the admin.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
    
    
}
