<?php

namespace App\Controller\admin\employer;

use App\Entity\Employer;
use App\Form\EmployerType;

use App\Repository\EmployerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class EmployerController extends AbstractController
{
    /**
     * @Route("/gestion_employer",name="gestionemployer")
     */
    public function employer(Request $request, EntityManagerInterface $entityManager)
    {
        $employer = new Employer();
        $form=$this->createForm(EmployerType::class,$employer);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($employer);
            $em->flush();
        }
        $repo = $this->getDoctrine()->getRepository(Employer::class);
        $listEmployers = $repo->findAll();
        return $this->render("admin/employer/index.html.twig",['employers'=>$listEmployers,'form'=>$form->createView()]);
    }


    /**
     * @Route("/employer/{id}/edit_employer", name="employer_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Employer $employer, EmployerRepository $employerRepository): Response
    {
        $form = $this->createForm(EmployerType::class, $employer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employerRepository->add($employer);
            return $this->redirectToRoute('gestionemployer', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/employer/edit.html.twig', [
            'employer' => $employer,
            'form' => $form,
        ]);
    }

}