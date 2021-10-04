<?php


namespace App\Controller;

use App\Entity\TODO;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RequestController extends AbstractController
{

    /**
     * @Route("/logout", name="logout_request", methods={"POST"})
     */
    public function logout(){
        return $this->redirectToRoute('login_view');
    }

    /**
     * @Route("/new", name="create_request", methods={"POST"})
     */
    public function create(Request $request, EntityManagerInterface $em){

        $todo = new TODO();
        $todo->setNombre($request->request->get('nombre'));
        $todo->setFechaTope($request->request->get('fechaTope'));

        $em->persist($todo);
        $em->flush();
        return $this->redirectToRoute('todolist_view');
    }

}