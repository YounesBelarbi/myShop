<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart_show")
     */
    public function cartShow(SessionInterface $session, ProductRepository $productRepository): Response
    {
        $cart = $session->get('cart', []);
        $cartWithData = [];

        //prepare data product from cart to send to template
        foreach ($cart as $productId => $productQuantity) {
            $cartWithData[] = [
                'product' => $productRepository->find($productId),
                'quantity' => $productQuantity,
            ];
        }

        //calculation of total
        $total = 0;
        foreach ($cartWithData as $productInformation) {
            $total += $productInformation['product']->getPrice() * $productInformation['quantity'];
        }

        return $this->render('cart/index.html.twig', [
            'items' => $cartWithData,
            'total' => $total,
        ]);
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
