<?php
namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminProductController extends AbstractController
{
    /**
    * @var ProductRepository
    */
    private $repository;

    /**
     * @var EntityManagerRegistry
     */
    private $em;

    public function __construct(ProductRepository $repository, EntityManagerInterface $em) 
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
    * @Route("/admin", name="admin.product")
    * @return \Symfony\Component\HttpFoundation\Response
    */
    public function index()
    {
        $products = $this->repository->findAll();
        return $this->render('admin/product/products.html.twig', compact('products'));
    }

    /**
     * @Route("/admin/product/create", name="admin.product.new")
     * @param Request $request
     */
    public function new(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $product->setCreatedAt(new \DateTime());
            $this->em->persist($product);
            $this->em->flush();
            $this->addFlash('success', 'Produit ajouté avec succès');
            return $this->redirectToRoute('admin.product');
        }
        return $this->render('admin/product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView()
            ]);
    }

    /**
    * @Route("/admin/product/{id}/edit", name="admin.product.edit", methods="GET|POST")
    * @param Product $product
    * @param Request $request
    * @return \Symfony\Component\HttpFoundation\Response
    */
    public function edit(Product $product, Request $request) 
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Produit modifié avec succès');
            return $this->redirectToRoute('admin.product');
        }
        return $this->render('admin/product/edit.html.twig', [
        'product' => $product,
        'form' => $form->createView()
        ]);
    }

    /**
    * @Route("/admin/product/{id}", name="admin.product.delete", methods="DELETE")
    * @param Product $product
    * @param Request $request
    * @return \Symfony\Component\HttpFoundation\Response
    */
    public function delete(Product $product, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $product->getId(), $request->get('_token'))) {
            $this->em->remove($product);
            $this->em->flush();
            $this->addFlash('success', 'Produit supprimé avec succès');
        }
        return $this->redirectToRoute('admin.product');
    }
}