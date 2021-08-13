<?php

namespace App\Service;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    private $session;
    private $productRepository;

    public function __construct(SessionInterface $session, ProductRepository $productRepository)
    {
        $this->session = $session;
        $this->productRepository = $productRepository;
    }

    public function getCartContent()
    {
        $cart = $this->session->get('cart', []);
        $cartWithData = [];

        //prepare data product from cart to send to template
        foreach ($cart as $productId => $productQuantity) {
            $cartWithData[] = [
                'product' => $this->productRepository->find($productId),
                'quantity' => $productQuantity,
            ];
        }

        return $cartWithData;
    }

    public function getCartTotal()
    {
        //calculation of total
        $total = 0;
        foreach ($this->getCartContent() as $productInformation) {
            $total += $productInformation['product']->getPrice() * $productInformation['quantity'];
        }

        return $total;
    }

    public function removeCartContent()
    {
        $this->session->remove('cart');
    }
}