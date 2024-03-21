<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $password = Hash::make('123456');
        User::castAndCreate([
            'username' => 'Admin',
            'email' => 'admin@palajawi.com',
            'password' => $password,
            'admin' => true,
        ]);
        User::factory()->count(100)->create();
    }
}
