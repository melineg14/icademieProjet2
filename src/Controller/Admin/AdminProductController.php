<?php
namespace App\Controller\Admin;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminProductController extends AbstractController
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
    * @Route("/admin", name="admin.product")
    */
    public function index()
        {
        $products = $this->repository->findAll();
        return $this->render('admin/product/products.html.twig', compact('products'));
    }

    /**
    * @Route("/admin/{id}/edit", name="admin.product.edit")
    */
    public function edit(Product $product) 
    {
        $form = $this->createForm(ProductType::class, $product);
        return $this->render('admin/product/edit.html.twig', [
        'product' => $product,
        'form' => $form->createView()
        ]);
    }
}