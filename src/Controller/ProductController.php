<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/{id}", name="product_show")
     */
    public function product_show(Request $request, Product $product, SessionInterface $session): Response
    {
        $form = $this->createForm(ProductType::class);
        $form->handleRequest($request);
        $cart = $session->get('cart', []);

        if ($form->isSubmitted() && $form->isValid()) {

            if (isset($cart[$product->getId()])) {
                $cart[$product->getId()] = $form->getData()['quantity'];
            }

            $session->set('cart', $cart);
            return $this->redirectToRoute('cart_show');
        }

        return $this->render('product/index.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }
}
