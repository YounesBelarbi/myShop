<?php

namespace App\Controller;

use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart_show")
     */
    public function cartShow(CartService $cartService): Response
    {
        return $this->render('cart/index.html.twig', [
            'items' => $cartService->getCartContent(),
            'total' => $cartService->getCartTotal(),
        ]);
    }

    /**
     * @Route("/cart/empty", name="cart_empty")
     */
    public function cartEmpty(CartService $cartService): Response
    {
        $cartService->removeCartContent();
        return $this->redirectToRoute('cart_show');
    }
}
