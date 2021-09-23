<?php

namespace App\Controller;

use App\Entity\Library;
use App\Entity\Order;
use App\Form\LibraryType;
use App\Repository\LibraryRepository;
use App\Form\OrderType;
use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/order")
 */
class OrderController extends AbstractController
{
    /**
     * @Route("/", name="order_index", methods={"GET"})
     */
    public function index(OrderRepository $orderRepository ): Response
    {
        return $this->render('order/index.html.twig', [
            'orders' => $orderRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="order_new", methods={"GET","POST"})
     */
    public function new(Request $request,LibraryRepository $libraryRepository, Library $library): Response
    {
        $order = new Order();
        $order->setlibrary($library); 
        // dd($this->getUser()->getReader()
        $order->setReader($this->getUser()->getReader());
       
        $order->setStatus('WAITING');
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $library=$libraryRepository->findOneBy(['id'=>$order->getLibrary()]);
            \Stripe\Stripe::setApiKey('sk_test_51IudYJE6zq9JtjMeKaLVqVeD5DU44TdEw2kFMuak62VLwymNNoUTQpvqJEgaHZCAzh10DAo6f6P9O4bJsLc5qzSY00IVms15NF');
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $library->getPrice()*100,
                'currency' => 'eur'
            ]);
            
            
            
            $entityManager->persist($order);
            $entityManager->flush();

            return $this->redirectToRoute('order_index');
        }

        return $this->render('order/new.html.twig', [
            'order' => $order,
            'form' => $form->createView(),
        ]);
        

    }







    /**
     * @Route("/{id}", name="order_show", methods={"GET"})
     */
    public function show(Order $order): Response
    {
        return $this->render('order/show.html.twig', [
            'order' => $order,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="order_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Order $order): Response
    {
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('order_index');
        }

        return $this->render('order/edit.html.twig', [
            'order' => $order,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="order_delete", methods={"POST"})
     */
    public function delete(Request $request, Order $order): Response
    {
        if ($this->isCsrfTokenValid('delete'.$order->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($order);
            $entityManager->flush();
        }

        return $this->redirectToRoute('order_index');
    }
}
