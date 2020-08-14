<?php
namespace App\Controller;

use App\Service\Product\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/produits", name="products")
     */

    public function index(ProductService $productService)
    {
        return $this->render('pages/products.html.twig',[
            'current_page' => 'products',
            'products' => $productService->getAllProducts(),
        ]);
    }

    /**
    * @Route("/produits/detail/{id}", name="products_detail")
    */
    public function getDetail(ProductService $productService, $id)
    {
        $product = $productService->getOneProduct($id);
        return $this->render('pages/productDetail.html.twig',[
            'current_page' => 'products',
            'product' => $product,
        ]);
    }
}