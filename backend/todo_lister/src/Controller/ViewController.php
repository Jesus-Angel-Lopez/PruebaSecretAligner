<?php


namespace App\Controller;

use App\Entity\TODO;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    /**
     * @Route("/todoList/{list_id}", name="todolist_view", methods={"GET"})
     */
    public function homepage(EntityManagerInterface $em){

        $todolist = $em->getRepository(TODO::class)->findAll();

        return $this->render('todoList/todolist.html.twig',[
            'todoList' => $todolist
        ]);
    }

}