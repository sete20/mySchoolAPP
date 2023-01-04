<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'teacher@email.com',
            'user_type' => 'teacher',
            'phone' => 123456789,
            'name' => 'teacher',
            'password' => bcrypt(987654321)
        ]);
    }
}
