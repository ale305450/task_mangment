<?php

namespace App\Infrastructure\Persistence\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create Admin role
        $admin = Role::create(['name' => 'Admin']);
        //Create Project manger role
        $projectManger = Role::create(['name' => 'Project Manger']);
        //Create Employee
        $employee = Role::create(['name' => 'Employee']);

        //Assign permissions to Admin role
        $admin->givePermissionTo([
            'Add-category',
            'Edit-category',
            'Delete-category',
            'All-categories',
            'Delete-project',
            'All-projects',
        ]);

        //Assign permissions to Project Manger role
        $projectManger->givePermissionTo([
            'Add-category',
            'Add-project',
            'Edit-project',
            'Delete-project',
            'All-projects',
            'Add-task',
            'Edit-task',
            'Delete-task',
            'All-tasks',
        ]);

        //Assign permissions to Employer role
        $employee->givePermissionTo([
            'Task-compelete'
        ]);
    }
}
