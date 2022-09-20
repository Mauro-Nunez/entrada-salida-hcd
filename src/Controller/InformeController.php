<?php

namespace App\Controller;

use App\Entity\Novedad;
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
    public function index(EntityManagerInterface $entityManager): Response
    {
        $registros = $entityManager->getRepository(Novedad::class)->findAll();

        return $this->render('informe/index.html.twig', [
            'registros' => $registros,
            'controller_name' => 'InformeController',
        ]);
    }
}
