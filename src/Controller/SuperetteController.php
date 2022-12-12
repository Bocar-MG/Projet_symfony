<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SuperetteController extends AbstractController
{
    /**
     * @Route("/superette", name="app_superette")
     */
    public function index(): Response
    {
        return $this->render('superette/index.html.twig', [
            'controller_name' => 'SuperetteController',
        ]);
    }
}
