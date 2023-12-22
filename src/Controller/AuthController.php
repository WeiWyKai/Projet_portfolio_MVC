<?php

namespace App\Controller;
use App\Repository\UserRepository;

class AuthController extends AbstractController{

  public function login():void{
    
    $error=null;
    //Connexion 
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

      //Nettoyage des inputs
      $username = htmlspecialchars(strip_tags($_POST['username']));
      $password = htmlspecialchars(strip_tags($_POST['password']));

      //Verifier si le formulaire est rempli, sinon erreur
      if(!empty($username) && !empty($password))
      {

        //Verifies si un utilisateur existe via l'adresse email en BDD sinon erreur
        $userRepository = new UserRepository();
        $user=$userRepository->findByUsername($username);

        //Verifie si l'utilisateur existe et si le mdp est correct sinon erreur
        if($user && password_verify($password, $user->getPassword()))
        {

          //Création de la session de connexion
          $_SESSION['user']=$user;

          //Redirection vers l'administration
          header('Location: /portfolio/admin');
          exit;

        }else
        {
          $error ='Identifiants incorrects';
        }
      }else{
        $error ='Identifiants incorrects';
      }
    }

    $this->view('/auth/login.php',[
      'error' => $error]);
  }



}