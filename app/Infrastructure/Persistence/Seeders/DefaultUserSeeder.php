<?php

namespace App\Infrastructure\Persistence\Seeders;

use App\Core\Entities\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create user named admin and assign admin role to him
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin')
        ]);
        $admin->assignRole('Admin');

        //Create user named admin and assign admin role to him
        $projectManger = User::create([
            'name' => 'projectManger',
            'email' => 'projectManger@gmail.com',
            'password' => Hash::make('projectManger')
        ]);
        $projectManger->assignRole('Project Manger');

        //Create user named admin and assign admin role to him
        $employee = User::create([
            'name' => 'employee',
            'email' => 'employee@gmail.com',
            'password' => Hash::make('employee')
        ]);
        $employee->assignRole('Employee');
    }
}
