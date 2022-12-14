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
     *
     * @return void
     */
    public function run()
    {
        User::create([
           'name' => "adminthawthaw",
            'email' => "thaw@gmail.com",
            'phone' => "09-969-786",
            'gender' => 'male',
            'address' => "Myeik",
            'role' => 'admin',
            'password' => Hash::make('admin123'),
        ]);


    }
}
