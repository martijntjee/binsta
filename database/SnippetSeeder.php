<?php

class SnippetSeeder
{
    public function load()
    {
        $snippets =
        [
            [
                'text' => 'Dit is een text',
                'language' => 'php',
                'color_scheme' => 'monokai',
            ],
            [
                'text' => 'Chineese keuken',
                'language' => 'php',
                'color_scheme' => 'monokai',
            ],
            [
                'text' => 'Hollandse keuken',
                'language' => 'php',
                'color_scheme' => 'monokai',
            ],
            [
                'text' => 'Mediterraans',
                'language' => 'php',
                'color_scheme' => 'monokai',
            ],
        ];

        return $snippets;
    }
}