<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProStageStageSpecifiqueController extends AbstractController
{
    /**
     * @Route("/stages/stage_specifique", name="pro_stage_stage_specifique")
     */
    public function index(): Response
    {
        return $this->render('pro_stage_stage_specifique/index.html.twig', [
            'controller_name' => 'ProStage_StageSpecifiqueController',
			'controller_id' => '"stage spécifique"',
        ]);
    }
}
