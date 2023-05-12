<?php

declare(strict_types=1);

namespace App\Controller;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class AbstractController
{
    protected $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../templates');
        $this->twig = new Environment($loader);
    }

    protected function render($template, $data = [])
    {
        echo $this->twig->render($template, $data);
    }
}

