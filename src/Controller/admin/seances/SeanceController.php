<?php

namespace App\Controller\admin\seances;



use App\Entity\Salle;
use App\Entity\Seance;

use App\Form\SeanceType;
use App\Repository\SeanceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SeanceController extends AbstractController
{
    /**
     * @Route("/seance/gestion_seance",name="gestionseance")
     */
    public function seance(Request $request, EntityManagerInterface $entityManager)
    {
        // Ajout d'une Seance
        $seance = new Seance();
        $form = $this->createForm(SeanceType::class, $seance);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($seance);
            $entityManager->flush();
        }


        // Recupere la liste des Categorie

        $repo = $this->getDoctrine()->getRepository(Seance::class);
        $listseances = $repo->findAll();

        $repo2 = $this->getDoctrine()->getRepository(Salle::class);
        $listsalle= $repo2->findAll();

        return $this->render("admin/seances/index.html.twig", array('seances'=>$listseances,'salles'=>$listsalle, 'form' => $form->createView()));
    }

    // ---------------------- Partie Crud ----------------------------------

    /**
     * @Route("/seance/{id}/edit_seance", name="seance_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Seance $seance, SeanceRepository $seanceRepository): \Symfony\Component\HttpFoundation\Response
    {
        $form = $this->createForm(SeanceType::class, $seance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $seanceRepository->add($seance);
            return $this->redirectToRoute('gestionseance', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/seances/edit.html.twig', [
            'seance' => $seance,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/seance/{id}", name="seance_delete", methods={"POST"})
     */
    public function delete(Request $request, Seance $seance, SeanceRepository $seanceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seance->getId(), $request->request->get('_token'))) {
            $seanceRepository->remove($seance);
        }

        return $this->redirectToRoute('gestionseance', [], Response::HTTP_SEE_OTHER);
    }

}