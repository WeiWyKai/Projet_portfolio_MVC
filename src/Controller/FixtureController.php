<?php

namespace App\Controller;

use Faker;
use App\Entity\Projet;
use App\Entity\User;
use App\Repository\ProjetRepository;
use App\Repository\UserRepository;

/**
 * Génère des fausses donnée pour le developpement
 */

 class FixtureController extends AbstractController{

  public function index():void{

    $faker = Faker\Factory::create();

    $projetRepository=new ProjetRepository();

    for($i=0;$i<10;$i++){
      //créer un objet avec l'entité "Projet"
      $projet = new Projet();
      $projet->setTitle($faker->sentence);
      $projet->setDescription($faker->realText);
      $projet->setPreview('test.png');
      $projet->setCreatedAt($faker->dateTimeBetween('-2 years')->format('Y-m-d'));
      $projet->setUpdatedAt($faker->dateTimeBetween('-1 years')->format('Y-m-d'));

      //Inserer en base de données
      $projetRepository->add($projet);

    }
    
    $userRepository=new UserRepository();

    for($i=0;$i<5;$i++){
      //créer un objet avec l'entité "ProjeUsert"
      $user = new User();
        $user->setUsername($faker->userName);
        $user->setPassword(password_hash('secret', PASSWORD_DEFAULT));
      //Inserer en base de données
      $userRepository->add($user);

    }

   $this->view('fixtures/index.php');
  }
 }