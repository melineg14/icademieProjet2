<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index(ProductRepository $repository): Response
    {
        $products = $repository->findAll();
        return $this->render('pages/home.html.twig', [
            'current_page' => 'home',
            'products' => $products
        ]);
    }
}