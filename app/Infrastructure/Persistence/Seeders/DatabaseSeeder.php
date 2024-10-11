<?php

namespace App\Infrastructure\Persistence\Seeders;
//
use App\Core\Entities\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Infrastructure\Persistence\Seeders\PermissionSeeder;
use App\Infrastructure\Persistence\Seeders\RoleSeeder;
use App\Infrastructure\Persistence\Seeders\DefaultUserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            DefaultUserSeeder::class,
        ]);
    }
}
