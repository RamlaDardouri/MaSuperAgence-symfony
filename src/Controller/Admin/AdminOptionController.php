<?php

namespace App\Controller\Admin;

use App\Entity\Option;
use App\Form\OptionType;
use App\Repository\OptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/admin/option")
 */
class AdminOptionController extends AbstractController
{
    /**
     * @Route("/", name="admin.option.index")
     * @Method({"GET"})
     */
    public function index(OptionRepository $optionRepository): Response
    {
        return $this->render('option/index.html.twig',  [
            'options' => $optionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin.option.new")
     * @Method({"GET","POST"})
     */
    public function new(Request $request): Response
    {
   
        
        $option = new Option();
        $form = $this->createForm(OptionType::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($option);
            $entityManager->flush();

            return $this->redirectToRoute('admin.option.index');
        }

        return $this->renderForm('option/new.html.twig', [
            'option' => $option,
            'form' => $form,
        ]);
    }

    
    /**
     * @Route("/{id}/edit", name="admin.option.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Option $option): Response
    {
        $form = $this->createForm(OptionType::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin.option.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('option/edit.html.twig', [
            'option' => $option,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/delete", name="admin.option.delete", methods={"POST"})
     */
    public function delete(Request $request, Option $option): Response
    {
       
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($option);
            $entityManager->flush();
        

        return $this->redirectToRoute('admin.option.index', [], Response::HTTP_SEE_OTHER);
    }
}
