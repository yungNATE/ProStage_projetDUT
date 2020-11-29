<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProStageEntreprisesController extends AbstractController
{
    /**
     * @Route("/entreprises", name="pro_stage_entreprises")
     */
    public function index(): Response
    {
        return $this->render('pro_stage_entreprises/index.html.twig', [
            'controller_name' => 'ProStage_entreprisesController',
        ]);
    }
}
