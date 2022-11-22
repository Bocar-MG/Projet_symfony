<?php

namespace App\Controller\admin\spectacle;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class SpectacleController extends AbstractController
{
    /**
     * @Route("/gestion_spectacle")
     */
    public function spectacle()
    {
        return $this->render("admin/spectacle/index.html.twig");
    }
}