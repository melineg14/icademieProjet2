<?php
namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @var ProductRepository
     */
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * @Route("/produits", name="products")
     * @return Response
     */

    public function index(): Response
    {
        $products = $this->repository->findAll();
        return $this->render('pages/products.html.twig',[
            'current_page' => 'products',
            'products' => $products
        ]);
    }
}