<?php

class CommentSeeder
{
    public function load()
    {
        $comments =
        [
            [
                'text' => 'Dit is een text',
                'posted_on' => date('Y/m/d H:i:s'),
            ],
            [
                'text' => 'Chineese keuken',
                'posted_on' => date('Y/m/d H:i:s'),
            ],
            [
                'text' => 'Hollandse keuken',
                'posted_on' => date('Y/m/d H:i:s'),
            ],
            [
                'text' => 'Mediterraans',
                'posted_on' => date('Y/m/d H:i:s'),
            ],
        ];

        return $comments;
    }
}