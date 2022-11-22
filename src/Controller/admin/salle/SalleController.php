<?php

namespace App\Controller\admin\salle;


use App\Entity\Salle;

use App\Form\SalleType;

use App\Repository\SalleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SalleController extends AbstractController
{
    /**
     * @Route("/salle/gestion_salle", name="gestionsalle")
     */
    public function salle(Request $request,EntityManagerInterface $entityManager)
    {
        // Ajout d'une Salle

        $salle = new Salle();
        $form = $this->createForm(SalleType::class, $salle);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($salle);
            $entityManager->flush();
        }



        // Liste Des Salles
        $repo = $this->getDoctrine()->getRepository(Salle::class);
        $salles = $repo->findAll();

        return $this->render("admin/salle/index.html.twig",array('salles'=>$salles,'form'=>$form->createView()));
    }


    // ------------------ Partie Crud ------------------------------------
    /**
     * @Route("/salle/{id}/edit_salle", name="salle_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Salle $salle, SalleRepository $salleRepository): Response
    {
        $form = $this->createForm(SalleType::class, $salle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $salleRepository->add($salle);
            return $this->redirectToRoute('gestionsalle', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/salle/edit.html.twig', [
            'salle' => $salle,
            'form' => $form,
        ]);
    }
    /**
     * @Route("/salle/{id}", name="salle_delete", methods={"POST"})
     */
    public function delete(Request $request, Salle $salle, SalleRepository $salleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$salle->getId(), $request->request->get('_token'))) {
            $salleRepository->remove($salle);
        }

        return $this->redirectToRoute('gestionsalle', [], Response::HTTP_SEE_OTHER);
    }


}