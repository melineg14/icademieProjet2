<?php

namespace App\Service\Product;

use App\Repository\ProductRepository;

class ProductService
{
    /**
     * @var ProductRepository
     */
    protected $ProductRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;   
    }

    public function getAllProducts()
    {
        return $this->productRepository->findAllByDate();
    }

    public function getOneProduct($id)
    {
        return $this->productRepository->find($id);
    }
}