<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProStageFormationsController extends AbstractController
{
    /**
     * @Route("/formations", name="pro_stage_formations")
     */
    public function index(): Response
    {
        return $this->render('pro_stage_formations/index.html.twig', [
            'controller_name' => 'ProStage_formationsController',
        ]);
    }
}
