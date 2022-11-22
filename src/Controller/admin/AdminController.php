<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 * Class AdminController
 * @package App\Controller\admin
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/home", name="admin")
     */
    public function admin()
    {
        return $this->render("admin/home.html.twig");
    }
}