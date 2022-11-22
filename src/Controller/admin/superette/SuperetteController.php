<?php

namespace App\Controller\admin\superette;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class SuperetteController extends AbstractController
{
    /**
     * @Route("/gestion_superette")
     */
    public function seance()
    {
        return $this->render("admin/superette/index.html.twig");
    }
}