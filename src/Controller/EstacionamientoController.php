<?php

namespace App\Controller;

use App\Entity\Novedad;
use App\Form\NovedadType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EstacionamientoController extends AbstractController
{


    public function index(Request $request,EntityManagerInterface $entityManager): Response
    {   
        $registro= new Novedad();
        $form= $this->createForm(NovedadType::class, $registro);
        $registros= $entityManager->getRepository( Novedad::class )->findAll();
        $form->handleRequest($request);

		if ($form->isSubmitted()) {
            $registro->setFecha(new \DateTime());
            $registro->setEntrada(true);
            $entityManager->persist($registro);
            $entityManager->flush();

        return $this->redirectToRoute('estacionamiento');
        }

        return $this->render('estacionamiento/index.html.twig', [
            'controller_name' => 'EstacionamientoController','form'=>$form->createView(),'registroshoy'=>$registros
        ]);
    }

    public function eliminar(Novedad $registro,EntityManagerInterface $entityManager): Response{
            $entityManager->getRepository( Novedad::class )->remove($registro,true);


            return $this->redirectToRoute('estacionamiento');
    }

    public function egresar(Novedad $id,EntityManagerInterface $entityManager): Response{

            $id->setEgreso(new \DateTime());
            $entityManager->flush();
            return $this->redirectToRoute('estacionamiento');
    }
}
