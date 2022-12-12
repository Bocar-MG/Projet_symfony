<?php

namespace App\Controller\admin\superette;

use App\Entity\Superette;
use App\Form\SuperetteType;
use App\Repository\SuperetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SuperetteController extends AbstractController
{
    /**
     * @Route("/superette/gestion_superette",name="gestionsuperette")
     */
    public function addsuperette(Request $request, EntityManagerInterface $entityManager)
    {
        // Ajout d'un produit

        $produit = new Superette();
        $form = $this->createForm(SuperetteType::class, $produit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($produit);
            $entityManager->flush();
        }
        $listeproduits = $this->getDoctrine()->getRepository(Superette::class)->findAll();


        return $this->render("admin/superette/index.html.twig", array('form' => $form->createView(),'produits'=>$listeproduits));
    }


    /**
     * @Route("/superette/{id}/edit_produit", name="produit_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Superette $superette, SuperetteRepository $superetteRepository): Response
    {
        $form = $this->createForm(SuperetteType::class, $superette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $superetteRepository->add($superette);
            return $this->redirectToRoute('gestionsuperette', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/superette/edit.html.twig', [
            'produit' => $superette,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/superette/{id}", name="produit_delete", methods={"POST"})
     */
    public function delete(Request $request, Superette $superette, SuperetteRepository $superetteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$superette->getId(), $request->request->get('_token'))) {
            $superetteRepository->remove($superette);
        }

        return $this->redirectToRoute('gestionsuperette', [], Response::HTTP_SEE_OTHER);
    }

}