<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Admin@123'),
            'remember_token' => null,
            'position_by' => 1,
            'status' => 1,
        ];
        $user = User::updateOrCreate(['email'=>$admin['email']],$admin);
        if($user){
            $user->assignRole('admin');
        }


    }
}
