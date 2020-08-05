<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/produits", name="products")
     * @return Response
     */

    public function index(): Response
    {
        return $this->render('pages/products.html.twig');
    }
}