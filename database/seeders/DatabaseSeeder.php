<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name'=> 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Admin@123')
        ]);
        Role::create(['name' => 'super_admin', 'guard_name' => 'web']);


        User::whereId(1)->first()->roles()->attach([1]);
    }
}
