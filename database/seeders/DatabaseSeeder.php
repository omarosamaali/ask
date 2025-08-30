<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' =>  bcrypt('123456789'),
            'status' => '0'
        ]);

        User::factory()->create([
            'name' => 'Tarek',
            'email' => 'coder3rb@gmail.com',
            'password' =>  bcrypt('123456789'),
            'status' => '0'
        ]);


        $this->call([
            FaqSeeder::class,
            // أضف seeders أخرى هنا
        ]);
    }
}
