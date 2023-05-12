<?php
declare(strict_types=1);

namespace App\Controller;
use App\Controller\AbstractController;
use http\Client\Response;

class HomeController extends AbstractController
{
    public function index()
    {
        return $this->render('home/index.html.twig');
    }
}