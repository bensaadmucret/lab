<?php
declare(strict_types=1);

namespace App\Controller;
use App\Controller\AbstractController;

class AboutController extends AbstractController
{
    public function index()
    {
        return $this->render('about/index.html.twig');
    }

}