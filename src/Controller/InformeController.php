<?php

namespace App\Controller;

use DateTime;
use Knp\Snappy\Pdf;
use App\Entity\Novedad;
use App\Form\InformeType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InformeController extends AbstractController
{

    public function __construct(Pdf $knpSnappyPdf)
    {

        $this->knpSnappyPdf = $knpSnappyPdf;
    }

    /**
     * @Route("/informe", name="app_informe")
     */
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $desde = date("Y-m-d 00:00:00");
        $hasta = date("Y-m-d 23:59:59");
        $form = $this->createForm(InformeType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $data = $form->getData();
            $desde = $data['desde'];
            $hasta = $data['hasta'];
            $hasta->modify('+1 day');

            $registros = $entityManager->getRepository(Novedad::class)->findFecha($desde, $hasta);
            $busqueda = true;

            $desde = $desde->format("Y-m-d 00:00:00");
            $hasta = $hasta->format("Y-m-d 23:59:59");
        } else {
            $registros = $entityManager->getRepository(Novedad::class)->findAll();
            $busqueda = false;
        }

        return $this->render('informe/index.html.twig', [
            'desde' => $desde,
            'hasta' => $hasta,
            'registros' => $registros,
            'busqueda' => $busqueda,
            'form' => $form->createView(),
            'controller_name' => 'InformeController',
        ]);
    }

    /**
     * @Route("/informe/imprimir/{desde}/{hasta}", name="informe_imprimir")
     */
    public function imprimir_informe(EntityManagerInterface $entityManager,  $desde,  $hasta): Response
    {


        $html = $this->renderView(
            'informe/informe_pdf.twig',
            [
                'desde' => $desde,
                'hasta' => $hasta
            ]
        );

        $registros = $entityManager->getRepository(Novedad::class)->findFecha($desde, $hasta);

        $fechaactual = new DateTime('now');

        return new PdfResponse(
            $this->knpSnappyPdf->getOutputFromHtml($html),
            'Informe Segurida.pdf'
        );
    }
}
