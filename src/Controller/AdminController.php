<?php

namespace App\Controller;

class AdminController extends AbstractController{

  public function __construct()
  {
    //Si utilisateur pas connecté, on le redirige vers le formulaire
    if(!$this->isLogged())
    {
      header ('Location: /portfolio/login');
    }
    $this->view('auth/admin.php');
  }

  public function index():void{

    $projetRepository = new ProjetRepository();

    $this->view('home/index.php',[
      'projects' => $projetRepository->findAll()
    ]);
  }

}