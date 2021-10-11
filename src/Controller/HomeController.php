<?php 
namespace App\Controller;

use Twig\Environment;
use App\Repository\PropretyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
   



public function index(PropretyRepository $repository): Response

{
    $properties= $repository->findLatest();
    return $this->render('pages/home.html.twig',[
        'properties'=>$properties
    ]);
}



}