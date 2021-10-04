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
     * @Route("todoList/new", name="create_request", methods={"POST"})
     */
    public function create(Request $request, EntityManagerInterface $em){

        $todo = new TODO();
        $todo->setNombre($request->request->get('nombre'));
        $todo->setFechaTope($request->request->get('fechaTope'));

        $em->persist($todo);
        $em->flush();
        return $this->redirectToRoute('todolist_view');
    }

    /**
     * @Route("todoList/{todo_id}/{status}", name="changeStatus_request", methods={"PUT"})
     */
    public function estado($todo_id, $status, EntityManagerInterface $em){
        $estado = !($status=='completada');
        var_dump($estado);
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

}