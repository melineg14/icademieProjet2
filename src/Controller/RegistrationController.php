<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRegistrationType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    /**
    * @var UserRepository
    */
    private $repository;

    /**
     * @var EntityManagerRegistry
     */
    private $em;

    public function __construct(UserRepository $repository, EntityManagerInterface $em) 
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/registration", name="registration")
     * @param Request $request
     */
    public function index(Request $request)
    {
        $users = $this->repository->findAll();
        $user = new User();
        $form = $this->createForm(UserRegistrationType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($user);
            $this->em->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('pages/registration.html.twig', [
            'users' => $users,
            'form' => $form->createView(),
            'current_page' => 'registration'
            ]);
    }
}