<?php

namespace App\Controller\admin\spectacle;

use App\Entity\Spectacle;
use App\Form\SpectacleType;
use App\Repository\SpectacleRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SpectacleController extends AbstractController
{
    /**
     * @Route("/gestion_spectacle", name="gestionspectacle")
     */
    public function spectacle(Request $request, EntityManagerInterface $entityManager)
    {
        $spectacle=new Spectacle();
        $form=$this->createForm(SpectacleType::class,$spectacle);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($spectacle);
            $em->flush();
        }
        $repo=$this->getDoctrine()->getRepository(Spectacle::class);
        $listeSpectacle=$repo->findAll();
        return $this->render("admin/spectacle/index.html.twig", ['spectacles'=>$listeSpectacle, 'form'=>$form->createView()]);
    }

    /**
     * @Route("/spectacle/{id}/edit_spectacle", name="spectacle_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Spectacle $spectacle, SpectacleRepository $spectacleRepository): Response

    {
        $form=$this->createForm(SpectacleType::class,$spectacle);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()){
            $spectacleRepository->add($spectacle);
            return $this->redirectToRoute("gestionspectacle",[],Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/spectacle/edit.html.twig', [
            'employer' => $spectacle,
            'form' => $form]);
    }

}