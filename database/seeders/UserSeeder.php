<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'name' => 'Abdelfttah Mohamed',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456789'),
//            'is_super_admin' => true,
        ]);
    }
}
