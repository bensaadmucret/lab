<?php
declare(strict_types=1);

namespace App\Controller;

final class ErrorController
{
    public static function error404()
    {
        header("HTTP/1.0 404 Not Found");
        echo 'Page not found';
        exit;
    }
}