<?php

function loadTemplate($template, $variables = [])
{
    $loader = new Twig\Loader\FilesystemLoader('../views');
    $twig = new Twig\Environment($loader, [
        'debug' => true,
    ]);
    $twig->addExtension(new Twig\Extension\DebugExtension());
    $twig->addGlobal('session', $_SESSION);
    return $twig->display($template, $variables);
}

function error($errorNumber, $errorMessage)
{
    http_response_code($errorNumber);
    loadTemplate('error.twig', ['errorMessage' => $errorMessage]);
    exit();
}
