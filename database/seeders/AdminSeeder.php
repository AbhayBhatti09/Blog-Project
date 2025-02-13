<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'Abhay Bhatti',
            'email'=>'abhaytest09@gmail.com',
            'password'=>Hash::make('12345678'),
            'role'=>1,

        ]);
    }
}
