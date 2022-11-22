<?php

namespace App\Controller\admin\film;

use App\Entity\Categorie;
use App\Entity\Film;
use App\Form\Film1Type;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Form\FilmType;


class FilmController extends AbstractController
{
    /**
     * @Route("/film/gestion_film",name="gestionfilm")
     */
    public function film(Request $request, EntityManagerInterface $entityManager)
    {
        // Ajout d'un Film

        $film = new Film();
        $form = $this->createForm(Film1Type::class, $film);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($film);
            $entityManager->flush();
        }


        // Recupere la liste des Categorie

        $repo = $this->getDoctrine()->getRepository(Film::class);
        $listFilms = $repo->findAll();


        $repo2 = $this->getDoctrine()->getRepository(Categorie::class);
        $listCategorie = $repo2->findAll();

        return $this->render("admin/film/index.html.twig", array('films' => $listFilms, 'categories' => $listCategorie, 'form' => $form->createView()));
    }



    // ---------------------- Partie Crud ----------------------------------

    /**
     * @Route("/film/{id}/edit_film", name="film_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Film $film, FilmRepository $filmRepository): Response
    {
        $form = $this->createForm(Film1Type::class, $film);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $filmRepository->add($film);
            return $this->redirectToRoute('gestionfilm', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/film/edit.html.twig', [
            'film' => $film,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/film/{id}", name="film_delete", methods={"POST"})
     */
    public function delete(Request $request, Film $film, FilmRepository $filmRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$film->getId(), $request->request->get('_token'))) {
            $filmRepository->remove($film);
        }

        return $this->redirectToRoute('gestionfilm', [], Response::HTTP_SEE_OTHER);
    }

}