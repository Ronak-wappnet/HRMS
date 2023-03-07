<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //creating Admin 
        $user = User::create([
            'name' => 'Ronak',
            'email' => 'ronak.wappnet@gmail.com',
            'password' => Hash::make('Ronak@123'),
        ]);

        // assigning admin Role and editUser permission to Admin
                
        $user->assignRole('Admin');
        $user->givePermissionTo('editUser');
    }
}
