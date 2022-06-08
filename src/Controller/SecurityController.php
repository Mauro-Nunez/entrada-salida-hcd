<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\LoginType;


class SecurityController extends AbstractController
{

    public function index(): Response
    {
        $form= $this->createForm(LoginType::class);

        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController', 'form'=>$form->createView()
        ]);

    }
}
