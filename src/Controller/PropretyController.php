<?php

namespace App\Controller;

use App\Entity\Proprety;
use App\Entity\PropretySearch;
use App\Form\PropretySearchType;
use App\Repository\PropretyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;




class PropretyController extends AbstractController
{
/**
 *  @var PropretyRepository
 */
    private $repository;
public function __construct(PropretyRepository $repository)
{

    $this->repository=$repository;
}


    /**
     * @Route("/biens", name="proprety.index")
     * @return Response
     */

    public function index(PaginatorInterface $paginator , Request $request): Response
    {
        $search = new PropretySearch();
        $form = $this->createForm(PropretySearchType::class,$search);
        $form->handleRequest($request);


        $propreties= $paginator->paginate (
        $this->repository->findAllVisibleQuery($search),
        $request->query->getInt('page',  1), 
        12
    );

     return $this->render('pages/index.html.twig',[
         'current_menu'=>'properties',
        'propreties' =>$propreties,
        'form'  =>$form->createView()
        ]);
    }

    /**
     * @Route("/biens/{slug}/{id}", name="proprety.show" ,requirements={"name"=".+"})
     * @return Response
     */

     public function show(Proprety $proprety , string $slug): Response
     {
         if($proprety->getSlug() !==$slug)
         {
             return $this->redirectToRoute('proprety.show',[
         'id'=> $proprety->getId(),
         'slug' => $proprety->getSlug()
             ], 301);
         }
         //$proprety = $this->repository->find($id);
         return $this->render('pages/show.html.twig', 
         ['proprety' => $proprety,
             'current_menu' => 'properties']);
     }




}