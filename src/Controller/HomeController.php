<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Library;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {    $library = $this->getDoctrine()
        ->getRepository(Library::class)
        ->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'library' => $library,
        ]);
    }
}



