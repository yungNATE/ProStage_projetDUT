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
	
	/**
     * @Route("/formations", name="pro_stage_formations")
     */
    public function afficherPage_formations(): Response
    {
        return $this->render('pro_stage_formations/index.html.twig');
    }
	
	/**
     * @Route("/stages/stage_specifique", name="pro_stage_stage_specifique")
     */
    public function afficherPage_stageSpecifique(): Response
    {
        return $this->render('pro_stage_stage_specifique/index.html.twig', [
			'controller_id' => '"stage spécifique"',
        ]);
    }
	
	/**
     * @Route("/entreprises", name="pro_stage_entreprises")
     */
    public function afficherPage_entreprises(): Response
    {
        return $this->render('pro_stage_entreprises/index.html.twig');
    }
}
