<?php


namespace App\Controller;

use App\Entity\ListaTODO;
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
    public function todolist(EntityManagerInterface $em){

        $todolist = $em->getRepository(TODO::class)->findAll();

        return $this->render('todoList/todolist.html.twig',[
            'todoList' => $todolist
        ]);
    }

    /**
     * @Route("/", name="lists_view", methods={"GET"})
     */
    public function homepage(EntityManagerInterface $em){

        if(in_array("ROLE_ADMIN",$this->getUser()->getRoles())){
            $lists = $em->getRepository(ListaTODO::class)->findAll();
        } else {
            $lists = $em->getRepository(ListaTODO::class)->findBy(['propietario' => $this->getUser()]);
        }
        return $this->render('todoList/lists.html.twig',[
            'lists' => $lists, 'admin' => in_array("ROLE_ADMIN",$this->getUser()->getRoles()), 'username' => $this->getUser()->getUserIdentifier()
        ]);
    }

}