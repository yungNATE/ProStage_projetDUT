<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProStageControllrController extends AbstractController
{
    /**
     * @Route("/", name="pro_stage_controllr")
     */
    public function index(): Response
    {
        return $this->render('pro_stage_controllr/index.html.twig');
    }
}
