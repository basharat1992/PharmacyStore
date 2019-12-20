<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$nM.s15ItD7wS3184rSDSeeenBtTfFdCFKxFEFysCOhsC8HJ9pf61S',
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
