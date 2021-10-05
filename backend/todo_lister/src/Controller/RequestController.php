<?php


namespace App\Controller;

use App\Entity\ListaTODO;
use App\Entity\TODO;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RequestController extends AbstractController
{

    /**
     * @Route("todoList/{list_id}/new", name="createTODO_request", methods={"POST"})
     */
    public function createTODO($list_id, Request $request, EntityManagerInterface $em){

        $todo = new TODO();
        $todo->setNombre($request->request->get('nombre'));
        $todo->setFechaTope($request->request->get('fechaTope'));

        $repository = $em->getRepository(ListaTODO::class);
        /** @var ListaTODO|null $list */
        $list = $repository->findOneBy(['id' => $list_id]);
        if(!$list) {
            throw $this->createNotFoundException(sprintf('La lista a la que intenta añadir un TODO no existe'));
        } else {
            $todo->setLista($list);
            $em->persist($todo);
            $em->flush();
            return $this->redirectToRoute('todolist_view',array('list_id' => $list_id));
        }
    }

    /**
     * @Route("todoList/{todo_id}/{status}", name="changeStatus_request", methods={"PUT"})
     */
    public function estadoTODO($todo_id, $status, EntityManagerInterface $em){
        $estado = !($status=='completada');
        $repository = $em->getRepository(TODO::class);
        /** @var TODO|null $todo */
        $todo = $repository->findOneBy(['id' => $todo_id]);
        if(!$todo){
            throw $this->createNotFoundException(sprintf('La tarea que desea editar no existe'));
        } else{
            if ($todo->isRealizada()!=$estado) {
                throw new \BadMethodCallException(sprintf('El cambio de estado que desea realizar no es posible'));
            } else{
                $todo->setRealizada(!$todo->isRealizada());
                $em->persist($todo);
                $em->flush();
                return new Response('Content',
                    Response::HTTP_OK,
                    array('content-type' => 'text/html'));
            }
        }
    }

    /**
     * @Route("/new", name="createList_request", methods={"POST"})
     */
    public function createList(Request $request, EntityManagerInterface $em){

        $list = new ListaTODO();
        $list->setNombre($request->request->get('nombre'));
        $repository = $em->getRepository(User::class);
        /** @var User|null $user */
        $user = $repository->findOneBy(['username' => $request->request->get('propietario')]);
        if(!$user) {
            throw $this->createNotFoundException(sprintf('El usuario para el que intenta crear una lista no existe'));
        } else {
            $list->setPropietario($user);
            $em->persist($list);
            $em->flush();
            return $this->redirectToRoute('lists_view');
        }
    }

    /**
     * @Route("/update/{list_id}", name="updateListOwner_request", methods={"PUT"})
     */
    public function updateListOwner($list_id, Request $request, EntityManagerInterface $em){

        $repository = $em->getRepository(ListaTODO::class);
        /** @var ListaTODO|null $list */
        $list = $repository->findOneBy(['id' => $list_id]);
        if(!$list) {
            throw $this->createNotFoundException(sprintf('La lista que intenta modificar no existe'));
        } else {
            $repository = $em->getRepository(User::class);
            /** @var User|null $list */
            $user = $repository->findOneBy(['username' => $request->request->get('propietario')]);
            if(!$user) {
                throw $this->createNotFoundException(sprintf('El usuario con el que intenta modificar una lista no existe'));
            } else{
                $list->setPropietario($user);
                $em->persist($list);
                $em->flush();
                return new Response('Content',
                    Response::HTTP_OK,
                    array('content-type' => 'text/html'));
            }
        }
    }

}