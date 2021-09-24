<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Library;
use App\Entity\Order;
use App\Repository\OrderRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(OrderRepository $orderRepository): Response
    {    
    //    $order=$orderRepository->FindAllWithJoin();
    $order = $this->getDoctrine()
  
    ->getRepository(Order::class)
    ->findAll();
    // dd($order);
        $library = $this->getDoctrine()
        ->getRepository(Library::class)
        ->findAll();
        //  dd($library);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'library' => $library,
            'orders' => $order,
        ]);
    }
}



