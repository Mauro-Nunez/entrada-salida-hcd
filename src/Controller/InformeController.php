<?php

namespace App\Controller;

use App\Entity\Novedad;
use App\Form\InformeType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InformeController extends AbstractController
{
    /**
     * @Route("/informe", name="app_informe")
     */
    public function index(EntityManagerInterface $entityManager,Request $request ): Response
    {
        $form= $this->createForm(InformeType::class);

        $form->handleRequest($request);

		if ($form->isSubmitted()) {
            $data=$form->getData();
            $desde=$data['desde'];
            $hasta=$data['hasta'];

            $registros = $entityManager->getRepository(Novedad::class)->findFecha($desde,$hasta);
            $busqueda=true;
        }
        else{
            $registros = $entityManager->getRepository(Novedad::class)->findAll();
            $busqueda=false;
        }

        return $this->render('informe/index.html.twig', [
            'registros' => $registros,
            'busqueda' => $busqueda,
            'form'=>$form->createView(),
            'controller_name' => 'InformeController',
        ]);
    }
}
