<?php

namespace App\Controller\admin\employer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class EmployerController extends AbstractController
{
    /**
     * @Route("/gestion_employer")
     */
    public function employer()
    {
        return $this->render("admin/employer/index.html.twig");
    }
}