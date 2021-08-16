<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/{slug}", name="product_show", requirements={"page"="\d+"})
     */
    public function product_show(Request $request, Product $product, RequestStack $requestStack): Response
    {
        $form = $this->createForm(ProductType::class);
        $form->handleRequest($request);
        $cart = $requestStack->getSession()->get('cart', []);

        if ($form->isSubmitted() && $form->isValid()) {
            $cart[$product->getId()] = $form->getData()['quantity'];
            $requestStack->getSession()->set('cart', $cart);
            return $this->redirectToRoute('cart_show');
        }

        return $this->render('product/index.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }
}
