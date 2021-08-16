<?php

namespace App\Service;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService
{
    private $session;
    private $productRepository;

    public function __construct(RequestStack $requestStack, ProductRepository $productRepository)
    {
        $this->session = $requestStack->getSession();
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

    public function addProductInCart(int $id)
    {
        $cart = $this->session->get('cart', []);
        $cart[$id]++;
        $this->session->set('cart', $cart);
    }

    public function reduceProductInCart($id)
    {
        $cart = $this->session->get('cart', []);
        if ($cart[$id] > 1) {
            $cart[$id]--;
        }
        $this->session->set('cart', $cart);
    }

    public function deleteProductFromCart($id)
    {
        $cart = $this->session->get('cart', []);
        unset($cart[$id]);
        $this->session->set('cart', $cart);
    }
}
