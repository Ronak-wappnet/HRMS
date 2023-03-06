<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {     
            $user=User::create([
            'name' => 'Ronak',
            'email' => 'ronak.wappnet@gmail.com',
            'password' => Hash::make('Ronak@123'), 
        ]);
        $user->assignRole('Admin');
        $user->givePermissionTo('editUser');
    }
}
