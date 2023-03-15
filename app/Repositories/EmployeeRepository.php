<?php

namespace App\Repositories;

use App\Interfaces\EmployeeInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeeRepository implements EmployeeInterface{

    /**
     * listEmployee() list all the users
     * 
     * @return data array
     */
    public function listEmployee()
    {
        $data = User::all();
        return $data;
    }

    /**
     * add() takes request or data array as argument
     * 
     * add employee
     * 
     * @return void
     */
    public function add($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);  
    }

    /**
     * edit() takes request and user as argument
     * 
     * @return void
     */
    public function edit($request, $user)
    {
        $user->update($request->all());
    }

    /**
     * find() will take id as argument
     * 
     * @return User array having user information 
     */
    public function find($id)
    {
        $user=User::find($id);
        return $user;
    }
    
    /** 
     * takes id as argument 
     * 
     * delete the user based on id and @return void
     */
    public function delete($id)
    {
        $user=User::find($id);
        $user->delete();
    }
}
?>