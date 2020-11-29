<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProStageStagesController extends AbstractController
{
    /**
     * @Route("/pro/stage/stages", name="pro_stage_stages")
     */
    public function index(): Response
    {
        return $this->render('pro_stage_stages/index.html.twig', [
            'controller_name' => 'ProStageStagesController',
        ]);
    }
}
