<?php

function loadTemplate($template, $variables = [])
{
    $loader = new Twig\Loader\FilesystemLoader('../views');
    $twig = new Twig\Environment($loader, [
        'debug' => true,
    ]);
    $twig->addExtension(new Twig\Extension\DebugExtension());
    $twig->addGlobal('session', $_SESSION);
    // add the timeAgo function to twig
    $twig->addFunction(new Twig\TwigFunction('timeAgo', function ($dateString) {
        $currentTime = new DateTime();
        $inputTime = new DateTime($dateString);

        $interval = $currentTime->diff($inputTime);

        if ($interval->y >= 1) {
            return $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
        } elseif ($interval->m > 1) {
            return $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
        } elseif ($interval->d >= 7) {
            $weeks = floor($interval->d / 7);
            return $weeks . ' week' . ($weeks > 1 ? 's' : '') . ' ago';
        } elseif ($interval->d >= 1) {
            return $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
        } elseif ($interval->h >= 1) {
            return $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
        } elseif ($interval->i >= 1) {
            return $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
        } else {
            return 'Just now';
        }
    }));
    return $twig->display($template, $variables);
}

function error($errorNumber, $errorMessage)
{
    http_response_code($errorNumber);
    loadTemplate('error.twig', ['errorMessage' => $errorMessage]);
    exit();
}
