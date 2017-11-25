<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UsuarioController extends Controller
{
    /**
     * @Route("/usuario/{id}", name="homepage")
     */
    public function indexAction(Request $request,$id )
    {
        
        $nombreUsuario="Liz Tejada";
        $nombreUsuario2='Jose Peña';
        $idUsuario=$id;
        // replace this example code with whatever you need
        return $this->render('AppBundle::usuarios.html.twig', array(
            'id' => $id,
            'nombreUsuario' => $nombreUsuario2,
            'nombreUsuario2' => $nombreUsuario,
        ));
    }
    
    
    
    
    
}
