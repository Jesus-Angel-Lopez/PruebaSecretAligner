<?php


namespace App\Controller;

use App\Entity\ListaTODO;
use App\Entity\TODO;
use App\Entity\User;
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
    public function todolist($list_id, EntityManagerInterface $em){
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $repository = $em->getRepository(ListaTODO::class);
        /** @var ListaTODO|null $list */
        $list = $repository->findOneBy(['id' => $list_id]);
        if(!$list) {
            throw $this->createNotFoundException(sprintf('La lista a la que deberia pertenecer esta TODOList no existe'));
        } else {
            $todolist = $em->getRepository(TODO::class)->findBy(['lista' => $list]);

            return $this->render('todoList/todolist.html.twig', [
                'todoList' => $todolist,
                'admin' => in_array("ROLE_ADMIN", $this->getUser()->getRoles()),
                'esPropietario' => $list->getPropietario() == $this->getUser(),
                'lista' => $list_id
            ]);
        }
    }

    /**
     * @Route("/", name="lists_view", methods={"GET"})
     */
    public function homepage(EntityManagerInterface $em){
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        if(in_array("ROLE_ADMIN",$this->getUser()->getRoles())){
            $lists = $em->getRepository(ListaTODO::class)->findAll();
        } else {
            $lists = $em->getRepository(ListaTODO::class)->findBy(['propietario' => $this->getUser()]);
        }
        return $this->render('todoList/lists.html.twig',[
            'lists' => $lists,
            'admin' => in_array("ROLE_ADMIN",$this->getUser()->getRoles()),
            'username' => $this->getUser()->getUserIdentifier()
        ]);
    }

    /**
     * @Route("/users", name="users_view", methods={"GET"})
     */
    public function users(EntityManagerInterface $em){
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $users = $em->getRepository(User::class)->findAll();
        return $this->render('todoList/users.html.twig',[
            'users' => $users,
            'admin' => in_array("ROLE_ADMIN",$this->getUser()->getRoles())
        ]);
    }

}