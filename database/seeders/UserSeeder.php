<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UserController;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            User::create([
            'name' => 'Admin',
            'email' => 'admin@bengkel',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
    }
}
