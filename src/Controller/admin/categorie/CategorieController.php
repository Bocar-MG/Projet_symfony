<?php

namespace App\Controller\admin\categorie;

use App\Entity\Categorie;
use App\Form\CategorieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Composer\Util\Http\Response;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\Routing\Annotation\Route;


class CategorieController extends AbstractController
{
    /**
     * @Route("/gestion_categorie")
     */
    public function categorie(Request $request,EntityManagerInterface $entityManager)

    {
        // Ajout d'un Categorie
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($categorie);
            $entityManager->flush();
        }


        // Recupere la liste des Categorie

        $repo = $this->getDoctrine()->getRepository(Categorie::class);
        $listCategorie = $repo->findAll();

        return $this->render("admin/categorie/index.html.twig",array('liste'=>$listCategorie,'form'=>$form->createView()));
    }
}