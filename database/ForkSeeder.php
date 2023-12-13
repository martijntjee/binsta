<?php

class ForkSeeder
{
    public function load()
    {
        $forks =
            [
                [
                    'created_at' => date('Y/m/d H:i:s'),
                ],
                [
                    'created_at' => date('Y/m/d H:i:s'),
                ],
                [
                    'created_at' => date('Y/m/d H:i:s'),
                ],
                [
                    'created_at' => date('Y/m/d H:i:s'),
                ]
            ];

        return $forks;
    }
}
