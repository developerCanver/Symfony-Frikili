<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisteruserController extends AbstractController
{
    /**
     * @Route("/registeruser", name="registeruser")
     */
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        /*en el mismo metodo de retornar se captura el form y se crea el usuario */
        /* llmao el merodo para cre usuario */
        $user = new User();

        //capturo el formulario UserTupe que cree
        $form = $this->createForm(UserType::class,$user);
        //obtener los datos del formulario
        
        $form->handleRequest($request);


        //validar si el formulario es enviado y es valido
        //si existe crear el usuario
        // de lo contrario retornar 
        if ($form->isSubmitted() && $form->isValid()) {
            //manejado de las entdaddes 
            // manehjo de Crud
            $em = $this->getDoctrine()->getManager();

            //como los d¿2  atributos de Baneado y Rol no los capturo
            //los quemo de esta siguiente manera
            $user->setBaneado('false');
            $user->setRoles(['ROLE_USER']);
            //incritar passworrdd
            $user->setPassword($passwordHasher->hashPassword(
                             $user,
                             $form['password']->getData()
                             ));

            //persistie al usuario que esta resibiendo
            $em->persist($user);
            $em->flush();
            //mostrar mensaje 
            $this->addFlash('exito','Se ha registrado exitosamente');
            //retorne al la URL registeruser
            return $this->redirectToRoute('registeruser');
        }
        return $this->render('registeruser/index.html.twig', [
            'controller_name' => 'Hola Mundo',
            'formularioUser' => $form->createView(),
        ]);
    }
}
