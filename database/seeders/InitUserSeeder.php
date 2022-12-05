<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class InitUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            [
                'username' => 'admin',
                'email' => 'admin@admin.co.za',
                'password' => 'admin',
                'name' => 'Administrator'
            ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(
                ['username' => $user['username']],
                [
                    'email' => $user['email'],
                    'password' => Hash::make($user['password']),
                    'name' => $user['name']
                ]
            );
        }

    }
}
