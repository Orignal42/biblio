<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Library;
use App\Entity\Order;

use App\Repository\LibraryRepository;
use App\Repository\CategoryRepository;
use App\Repository\OrderRepository;
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(LibraryRepository $libraryRepository,CategoryRepository $CategoryRepository, OrderRepository $orderRepository): Response
    {    
    $library = $libraryRepository->findAll(); 
    //dd($library);   
    $order = $orderRepository->FindBy(['library' => $library]); 
     //dd($order);
  
        $category = $CategoryRepository->findAll();
        // dd($category);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'library' => $library,
            'orders' => $order,
            'categorys'=>$category,
        ]);
    }
}



