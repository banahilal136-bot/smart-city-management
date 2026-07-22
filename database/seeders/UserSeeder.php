<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Create the initial administrator account.
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@smartcity.com',
            ],
            [
                'name' => 'أحمد محمد',
                'phone' => '0999999999',
                'password' => 'password123',
                'role' => User::ROLE_ADMIN,
                'status' => User::STATUS_ACTIVE,
            ]
        );
    }
}