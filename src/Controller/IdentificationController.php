<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class IdentificationController extends AbstractController 
{
    /**
     * @Route("/login", name="identification")
     * @param AuthenticationUtils $authenticationUtils
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {   
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUserName = $authenticationUtils->getLastUsername();
        return $this->render('security/identification.html.twig', [
            'last_username' => $lastUserName,
            'error' => $error,
            'current_page' => 'identification'
        ]);
    }
}


// use App\Entity\User;
// use App\Form\UserIdentificationType;
// use App\Repository\UserRepository;
// use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\Routing\Annotation\Route;

// class IdentificationController extends AbstractController
// {
//      /**
//     * @var UserRepository
//     */
//     private $repository;

//     /**
//      * @var EntityManagerRegistry
//      */
//     private $em;

//     public function __construct(UserRepository $repository, EntityManagerInterface $em) 
//     {
//         $this->repository = $repository;
//         $this->em = $em;
//     }

//     /**
//      * @Route("/identification", name="identification")
//      * @param Request $request
//      */
//     public function index(Request $request)
//     {
//         $users = $this->repository->findAll();
//         $user = new User();
//         $form = $this->createForm(UserIdentificationType::class, $user);
//         $form->handleRequest($request);
//         if ($form->isSubmitted() && $form->isValid()) {
//             // $this->em->persist($user);
//             // $this->em->flush();
//             return $this->redirectToRoute('home');
//         }
//         return $this->render('pages/identification.html.twig', [
//             'users' => $users,
//             'form' => $form->createView()
//             ]);
//     }
// }