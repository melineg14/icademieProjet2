<?php

namespace App\Service\Cart;

use App\Repository\CartRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var CartRepository
     */
    protected $cartRepository;

    public function __construct(SessionInterface $session, ProductRepository $productRepository, EntityManagerInterface $em, CartRepository $cartRepository)
    {
        $this->session = $session;
        $this->productRepository = $productRepository;
        $this->em = $em;
        $this->cartRepository = $cartRepository;
    }

    public function add(int $id)
    {
        $cart = $this->session->get('cart', []);

        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        $this->session->set('cart', $cart);
    }

    public function remove(int $id)
    {
        $cart = $this->session->get('cart', []);

        if (!empty($cart[$id])) {
            unset($cart[$id]);
        }

        $this->session->set('cart', $cart);
    }

    public function removeOne(int $id)
    {
        $cart = $this->session->get('cart', []);

        if ($cart[$id] > 1) {
            $cart[$id]--;
        } else {
            unset($cart[$id]);
        }

        $this->session->set('cart', $cart);
    }

    public function getFullCart(): array
    {
        $cart = $this->session->get('cart', []);
        $cartWithData = [];
        foreach ($cart as $id => $quantity) {
            $cartWithData[] = [
                'product' => $this->productRepository->find($id),
                'quantity' => $quantity
            ];
        }
        return $cartWithData;
    }

    public function showFullUserCart(int $idUser)
    {
        $cart = $this->cartRepository->findContent($idUser);
        if ($cart) {
            $content = $cart[0]['content'];
            $cartWithData = [];
            foreach ($content as $id => $quantity) {
                $cartWithData[] = [
                    'product' => $this->productRepository->find($id),
                    'quantity' => $quantity
                ];
            }
            return $cartWithData;
        } else {
            return null;
        }
    }

    public function getFullUserCart()
    {
        $cart = $this->session->get('cart', []);
        return $cart;
    }

    public function getTotal(): float
    {
        $total = 0;

        foreach ($this->getFullCart() as $item) {
            $total += $item['product']->getPrice() * $item['quantity'];
        }
        return $total;
    }

    public function registrationInDb($cart)
    {
        $this->em->persist($cart);
        $this->em->flush();
    }
}
