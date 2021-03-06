<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call([
         	RoleSeeder::class,
            ProductSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
         ]);
         \App\Models\User::factory(20)->create();
         
    }
}
