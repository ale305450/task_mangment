<?php

namespace App\Infrastructure\Persistence\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'Add-category',
            'Edit-category',
            'Delete-category',
            'All-categories',
            'Add-project',
            'Edit-project',
            'Delete-project',
            'All-projects',
            'Add-task',
            'Edit-task',
            'Delete-task',
            'All-tasks',
            'Task-compelete'
        ];

        // Looping and Inserting Array's Permissions into Permission Table
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
