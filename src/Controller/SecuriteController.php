<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecuriteController extends AbstractController
{
    #[Route('/register', name: 'security_register')]
    public function register(Request $request,EntityManagerInterface $manager,PasswordEncodeerInterface $): Response
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class,$user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $password_hash = 
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('securite/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
