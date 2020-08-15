<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Repository\UserRepository;
use App\Service\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="cart")
     */
    public function index(CartService $cartService, UserRepository $userRepository)
    {
        $user = $this->getUser();
        if (!isset($user)) {
            return $this->render('pages/cart.html.twig', [
                'current_page' => 'cart',
                'items' => $cartService->getFullCart(),
                'total' => $cartService->getTotal(),
            ]);
        } else {
            return $this->render('pages/cart.html.twig', [
                'current_page' => 'cart',
                'items' => $cartService->getFullCart(),
                'total' => $cartService->getTotal(),
                'userItems' => $cartService->showFullUserCart($this->getUser()->getId())
            ]);
        }
    }

    /**
     * @Route("/panier/add/{id}", name="cart_add")
     */
    public function add($id, CartService $cartService)
    {
        $cartService->add($id);
        $this->updateUserCart($cartService);
        return $this->redirectToRoute("cart");
    }

    /**
     * @Route("/panier/remove/{id}", name="cart_remove")
     */
    public function remove($id, CartService $cartService)
    {
        $cartService->remove($id);
        $this->updateUserCart($cartService);
        return $this->redirectToRoute("cart");
    }

    /**
     * @Route("/panier/removeone/{id}", name="cart_removeOne")
     */
    public function removeOne($id, CartService $cartService)
    {
        $cartService->removeOne($id);
        $this->updateUserCart($cartService);
        return $this->redirectToRoute("cart");
    }

    public function updateUserCart(CartService $cartService)
    {
        $user = $this->getUser();
        if (isset($user)) {
            $cart = new Cart();
            $userId = $this->getUser()->getId();
            $cart->setUser($user);
            $cart->setContent($cartService->getFullUserCart($userId));
            $cartService->registrationInDb($cart);
        }
    }
}
