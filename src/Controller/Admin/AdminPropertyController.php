<?php
namespace App\Controller\Admin;

use App\Entity\Proprety;
use App\Form\PropretyType;
use App\Repository\PropretyRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;




class AdminPropertyController extends AbstractController
{



/**
 * @var PropretyRepository
 */

 private $repository;


/**
 * @var EntityManagerInterface
 */
 private $em;

 public function __Construct(PropretyRepository $repository ,EntityManagerInterface $em)
 {
     $this->repository =$repository;
     $this->em =$em;
 }



 /**
  * @Route("/admin", name="admin.proprety.index")
  * @return \Symfony\Component\HttpFoundation\Response
  */
 public function index(): Response
 {
     $properties = $this->repository->findAll();
     return $this->render('admin/index.html.twig', compact('properties'));
 }


/**
 * @Route("/admin/new", name="admin.proprety.new")
 * @param Proprety $proprety
 * @param Request $request
 * @return \Symfony\Component\HttpFoundation\Response
 */

 public function new (Request $request)
 {
     $proprety= new Proprety();
     $form= $this->createForm(PropretyType::class, $proprety);
     $form->handleRequest($request);

     if ($form->isSubmitted()&& $form->isValid())
     { 
        $this->em->persist($proprety);
         $this->em->flush();
         $this->addFlash('success', 'Bien creé avec succé');
         return $this->redirectToRoute('admin.proprety.index');
     }

     return $this->render('admin/new.html.twig',
      ['proprety'=>$proprety,
        'form'=>$form->createView()
    ]);
 }


/**
 * @Route("/admin/edit/{id}", name="admin.proprety.edit")
 * @param Proprety $proprety
 * @param Request $request
 * @return \Symfony\Component\HttpFoundation\Response
 */

 public function edit (Proprety $proprety , Request $request)
 {
     $form= $this->createForm(PropretyType::class, $proprety);
     $form->handleRequest($request);

     if ($form->isSubmitted()&& $form->isValid())
     {
         $this->em->flush();
         $this->addFlash('success', 'Bien modifié avec succé');
         return $this->redirectToRoute('admin.proprety.index');
     }

     return $this->render('admin/edit.html.twig',
      ['proprety'=>$proprety,
        'form'=>$form->createView()
    ]);
 }



 /**
 * @Route("/admin/delete/{id}", name="admin.proprety.delete")
 * @Method({"DELETE"})
 * @param Proprety $proprety
 * @param Request $request
 * @return \Symfony\Component\HttpFoundation\Response
 */

public function delete (Proprety $proprety, Request $request )
{
    
    $this->em->remove($proprety);
    $this->em->flush();
    $this->addFlash('success', 'Bien supprimé avec succé');
    
      return $this->redirectToRoute('admin.proprety.index');
    

    
}





}