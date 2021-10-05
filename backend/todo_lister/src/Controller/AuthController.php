<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\PasswordHasherEncoder;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('todolist_view');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        return $this->redirectToRoute('app_login');
    }

    /**
     * @Route("/users/new", name="app_newUser", methods={"POST"})
     */
    public function createUser(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher){

        $repository = $em->getRepository(User::class);
        /** @var User|null $user */
        $user = $repository->findOneBy(['username' => $request->request->get('nombre')]);
        if($user) {
            throw $this->createNotFoundException(sprintf('El usuario para el que intenta crear una lista no existe'));
        } else {
            $user = new User();
            $user->setUsername($request->request->get('nombre'));
            $user->setRoles([$request->request->get('rol')]);
            $user->setPassword($passwordHasher->hashPassword($user, $request->request->get('password')));
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('users_view');
        }
    }
}
