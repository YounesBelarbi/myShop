<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart_show")
     */
    public function cartShow(): Response
    {
        return $this->render('cart/index.html.twig', []);
    }

    /**
     * @Route("/cart/empty", name="cart_empty")
     */
    public function cartEmpty(SessionInterface $session): Response
    {
        $session->remove('cart');
        return $this->redirectToRoute('cart_show');
    }
}
