<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\Stage;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
		/* Créat d'un générateur de données Fake */
		$faker = \Faker\Factory::create('fr_FR');
		
		
		/* Création des différents types de formations */
		$tableauFormations = array();
		$nombreDeVillesSouhaitees = 3; //chaque formation est localisée à $nombreDeVilleSouhaite emplacements différents
		
			//on crée chaque formation à la main (DUT INFO, LP NUM etc.) et pour chaque type on associe une ville aléatoirement générée. {e.q : DUT - Paris, LP - Reims, LP - Lyon}
		for ($numFormation=0; $numFormation< $nombreDeVillesSouhaitees; $numFormation++){
			$DUTInfo = new Formation();
			$DUTInfo-> setIntitule ("DUTInfo");
			$DUTInfo-> setNiveau ("2");
			$DUTInfo-> setVille ($faker->sentence($nbWords = 1, $variableNbWords = false));
			
				array_push($tableauFormations, $DUTInfo);
		}	
		
		for ($numFormation=0; $numFormation< $nombreDeVillesSouhaitees; $numFormation++){
			$LPNUM = new Formation();
			$LPNUM-> setIntitule ("LPNUM");
			$LPNUM-> setNiveau ("3");
			$LPNUM-> setVille ($faker->sentence($nbWords = 1, $variableNbWords = false));
			
				array_push($tableauFormations, $LPNUM);
		}
		
		for ($numFormation=0; $numFormation< $nombreDeVillesSouhaitees; $numFormation++){
			$LMathsInf = new Formation();
			$LMathsInf-> setIntitule ("LMathsInf");
			$LMathsInf-> setNiveau ("2");
			$LMathsInf-> setVille ($faker->sentence($nbWords = 1, $variableNbWords = false));
			
				array_push($tableauFormations, $LMathsInf);
		}
		// Mise en persistance des objets formation
        foreach ($tableauFormations as $formation) {
            $manager->persist($formation);
        }
		
		/* Création des différentes entreprises */
		$tableauEntreprises = array();
		$nombreDEntreprisesSouhaitees = 3;
		for ($numEntreprise=0; $numEntreprise< $nombreDEntreprisesSouhaitees; $numEntreprise++){
			$Entreprise = new Entreprise();
			$Entreprise-> setNom ($faker->sentence($nbWords = 2, $variableNbWords = false));
			$Entreprise-> setAdresse ($faker->sentence($nbWords = 5, $variableNbWords = false));
			$Entreprise-> setMilieu ($faker->sentence($nbWords = 1, $variableNbWords = false));
			
				array_push($tableauEntreprises, $Entreprise);
		}
		// Mise en persistance des objets entreprise
        foreach ($tableauEntreprises as $entreprise) {
            $manager->persist($entreprise);
        }
		
		/* Création des différentes stages */
		$tableauStages = array();
		$nombreDeStagesSouhaites = 3;
		for ($numStage=0; $numEntreprise< $nombreDEntreprisesSouhaitees; $numEntreprise++){
			$Stage = new Stage();
			$Stage-> setIntitule ($faker->sentence($nbWords = 2, $variableNbWords = false));
			$Stage-> setDescription ($faker->realText($maxNbChars = 200, $indexSize = 2));
			$Stage-> setDateDebut ($faker->dateTimeBetween($startDate = '-2 months', $endDate = 'now', $timezone = 'Europe/Paris'));
			$Stage-> setDuree ($faker->numberBetween($min = 0, $max = 6));
			$Stage-> setCompetencesRequises ($faker->realText($maxNbChars = 200, $indexSize = 2));
			$Stage-> setExperienceRequise ($faker->realText($maxNbChars = 200, $indexSize = 2));
			
				array_push($tableauStages, $Stage);
		}
		// La mise en persistance des stages sera faite dans la création des liens entre les entités
		
		/* Création des liens entre les différentes entités */
		//donner entreprise/formation(s) a chaque stage - et inversement, donner les stages aux entreprises et aux formations
		foreach ($tableauStages as $stage){
			//donner une entreprise aléatoire au stage  - et inversement
			$rdmEntreprise = array_rand($tableauEntreprises, 1);
			$stage-> setEntreprise ($rdmEntreprise);
				//réciproque
				$emplacementEntrepriseTraitee = array_search($rdmEntreprise, $tableauEntreprises); 	//cherche emplacement Entreprise courante
				$tableauEntreprises[$emplacementEntrepriseTraitee]-> addStage($stage);				//y ajoute le stage	
				$manager->persist($tableauEntreprises[$emplacementEntrepriseTraitee]);				//enregistre la modification
			
			//donner une/des formation(s) aléatoire(s) au stage (e.q : un stage peut proposer la formation au DUT de Paris, mais pas au DUT de St-Etienne)
			//- et inversement
			$rdmNbStage = $faker->numberBetween($min = 1, $max = count($tableauFormations));
			for ($numFormation=0; $numFormation < $rdmNbStage; $numFormation++){
				$rdmFormation =  array_rand($tableauFormations, 1);
				$stage-> addFormation($rdmFormation);
					//réciproque
					$emplacementFormationTraitee = array_search($rdmFormation, $tableauFormations);	//cherche emplacement Formation courante
					$tableauFormations[$emplacementFormationTraitee]-> addStage($stage);			//y ajoute le stage	
					$manager->persist($tableauFormations[$emplacementFormationTraitee]);			//enregistre la modification
			}
			
			$emplacementStageTraite = array_search($stage, $tableauStages);
			$manager->persist($tableauStages[$emplacementStageTraite]);		
		}
		
        $manager->flush();
    }
}
