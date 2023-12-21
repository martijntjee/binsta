<?php

class UserSeeder
{
    public function load()
    {
        $users =
        [
            [
                'username' => 'user1',
                'password' => 'password1',
                'email' => 'user1@test.com',
                'profile_picture' => 'henk.jpg',
                'bio' => 'I am user number 1',
                'display_name' => 'User One',
            ],
            [
                'username' => 'user2',
                'password' => 'password2',
                'email' => 'user2@test.com',
                'profile_picture' => 'henk.jpg',
                'bio' => 'I am user number 2',
                'display_name' => 'User Two',
            ],
            [
                'username' => 'user3',
                'password' => 'password3',
                'email' => 'user3@test.com',
                'profile_picture' => 'henk.jpg',
                'bio' => 'I am user number 3',
                'display_name' => 'User Three',
            ],
            [
                'username' => 'user4',
                'password' => 'password4',
                'email' => 'user4@test.com',
                'profile_picture' => 'henk.jpg',
                'bio' => 'I am user number 4',
                'display_name' => 'User Four',
            ],
            [
                'username' => 'user5',
                'password' => 'password5',
                'email' => 'user5@test.com',
                'profile_picture' => 'henk.jpg',
                'bio' => 'I am user number 5',
                'display_name' => 'User Five',
            ],
            [
                'username' => 'user6',
                'password' => 'password6',
                'email' => 'user6@test.com',
                'profile_picture' => 'henk.jpg',
                'bio' => 'I am user number 6',
                'display_name' => 'User Six',
            ],
            [
                'username' => 'user7',
                'password' => 'password7',
                'email' => 'user7@test.com',
                'profile_picture' => 'henk.jpg',
                'bio' => 'I am user number 7',
                'display_name' => 'User Seven',
            ],
            [
                'username' => 'user8',
                'password' => 'password8',
                'email' => 'user8@test.com',
                'profile_picture' => 'henk.jpg',
                'bio' => 'I am user number 8',
                'display_name' => 'User Eight',
            ],
            [
                'username' => 'user9',
                'password' => 'password9',
                'email' => 'user9@test.com',
                'profile_picture' => 'henk.jpg',
                'bio' => 'I am user number 9',
                'display_name' => 'User Nine',
            ],
            [
                'username' => 'user10',
                'password' => 'password10',
                'email' => 'user10@test.com',
                'profile_picture' => 'henk.jpg',
                'bio' => 'I am user number 10',
                'display_name' => 'User Ten',
            ],
        ];

        return $users;
    }
}