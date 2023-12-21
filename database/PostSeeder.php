<?php

class PostSeeder
{
    public function load()
    {
        $posts =
        [
            [
                'caption' => 'Dit is een caption',
                'created_at' => date('2021/m/d H:i:s'),
                'image' => 'dit-is-een-caption.jpg',
            ],
            [
                'caption' => 'Chineese keuken',
                'created_at' => date('Y/m/d H:i:s'),
                'image' => 'chineese-keuken.jpg',
            ],
            [
                'caption' => 'Hollandse keuken',
                'created_at' => date('Y/m/d H:i:s'),
                'image' => 'hollandse-keuken.jpg',
            ],
            [
                'caption' => 'Mediterraans',
                'created_at' => date('Y/m/d H:i:s'),
                'image' => 'mediterrane-keuken.jpg',
            ],
        ];

        return $posts;
    }
}