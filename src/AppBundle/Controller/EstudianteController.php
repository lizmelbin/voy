<?php
/**
 * Created by PhpStorm.
 * User: ltejada
 * Date: 08/12/2017
 * Time: 6:23 PM
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Estudiante;
use AppBundle\Form\EstudianteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * Class EstudianteController
 * @package AppBundle\Controller
 * @Route("/estudiantes")
 */
class EstudianteController extends Controller
{


    /**
     * @Route("/listas", name="crear_estudiante")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listarEstudiante(Request $request){

        return $this->render('AppBundle:Estudiante:Estudiante_lista.html.twig');

    }
    /**
     * @Route("/", name="crear_estudiante")
     * @Method("POST")
     * @param Request $request
     */
    public function createEstudiante(Request $request){
        //dump($request->getContent());
        //die;
        $data=json_decode($request->getContent(),true);
        $estudiante=new Estudiante();
        $form =$this->createForm(EstudianteType::class, $estudiante);
        $form->submit($data);
        if($form->isValid()){
            //echo "siiiiiiiiiiii";
            $em=$this->getDoctrine()->getManager();
            $em->persist($estudiante);
            $em->flush();
        }else{
           // echo "nooooooooo";

        }
        //para mostrar el objeto estudiante en la respuesta, como un Objeto del tipo Estudiante
        // dump($estudiante);
        //para devolverlo como un JSON//
        $data= $this->get("serializer")->serialize($estudiante,'json');

        $newEstudiante=json_decode($data,true);
        return new JsonResponse($newEstudiante);



    }

    /**
     * @Route("/{id}",name="update_estudiante")
     * @Method("PUT")
     * @param Request $request
     * @param  Estudiante $estudiante
     * @return JsonResponse
     */
    public function updateEstudiante(Request $request,Estudiante $estudiante){
        //dump($request->getContent());
        //die;
        $data=json_decode($request->getContent(),true);
        $form =$this->createForm(EstudianteType::class, $estudiante);
        $form->submit($data);
        if($form->isValid()){
            echo "siiiiiiiiiiii";
            $em=$this->getDoctrine()->getManager();

            $em->flush();
        }else{
            dump($form->getErrorsAsString());
            echo "nooooooooo";
        }
        die;
        //para mostrar el objeto estudiante en la respuesta, como un Objeto del tipo Estudiante
        // dump($estudiante);
        //para devolverlo como un JSON//
        $data= $this->get("serializer")->serialize($estudiante,'json');
        $newEstudiante=json_decode($data,true);
        return new JsonResponse($newEstudiante);
    }

    /**
     * @Route("/lista",name="todosLosEstudiantes")
     * @Method("GET")
     * @param Request $request
     * @return JsonResponse
     */
    public function getEstudiantes(Request $request){
        $estudiantes=$this->getDoctrine()->getRepository(Estudiante::class )->findAll();
        $data= $this->get("serializer")->serialize($estudiantes,'json');

        $listaEstudiantes=json_decode($data,true);
        return new JsonResponse($listaEstudiantes);
    }


    /**
     * @Route("/listado",name="todosLosEstudiantes")
     * @Method("GET")
     * @param Request $request
     * @return JsonResponse
     */
    public function ListarEstudiantes(Request $request){
     //TODO: buscar lista de estudiante en la base de datos
        $estudiantes=$this->getDoctrine()->getRepository(Estudiante::class)->findAll();
        return $this->render('AppBundle:Estudiante:Estudiante_lista.html.twig',array('estudiantes'=>$estudiantes,));

    }


    /**
     * @Route("/{id}/edit",name="EditarUnEstiante")
     * @Method("GET")
     * @param Request $request
     * @param  Estudiante $estudiante
     * @return JsonResponse
     */
    public function EditEstudiante(Request $request,Estudiante $estudiante){
        //TODO: buscar lista de estudiante en la base de datos
        //$estudiantes=$this->getDoctrine()->getRepository(Estudiante::class)->findAll();
       // $estudiante= $this->get("serializer")->serialize($estudiante,'json');
        return $this->render('AppBundle:Estudiante:edit_estudiantes.html.twig',array('estudiante'=>$estudiante,));

    }

}