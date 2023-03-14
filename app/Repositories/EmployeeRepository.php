<?php

namespace App\Repositories;

use App\Interfaces\EmployeeInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeeRepository implements EmployeeInterface{

    public function listEmployee()
    {
        $data = User::all();
        return $data;
    }

    public function add($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);  
    }

    public function edit($request, $user)
    {
        $user->update($request->all());
    }

    public function find($id)
    {
        $user=User::find($id);
        return $user;
    }
    
    public function delete($id)
    {
        $user=User::find($id);
        $user->delete();
    }
}
?>