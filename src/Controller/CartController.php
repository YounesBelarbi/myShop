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

    /**
     * @Route("/cart/add/{id}", name="cart_add")
     */
    public function add($id, CartService $cartService): Response
    {
        $cartService->addProductInCart($id);
        return $this->redirectToRoute('cart_show');
    }

    /**
     * @Route("/cart/reduce/{id}", name="cart_reduce")
     */
    public function reduce($id, CartService $cartService): Response
    {
        $cartService->reduceProductInCart($id);
        return $this->redirectToRoute('cart_show');
    }

    /**
     * @Route("/cart/delete/{id}", name="cart_delete")
     */
    public function delete($id, CartService $cartService): Response
    {
        $cartService->deleteProductFromCart($id);
        return $this->redirectToRoute('cart_show');
    }
}
