<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Repository\ProjetRepository;
use App\Service\UploadService;

class AdminController extends AbstractController{

  public function __construct()
  {
    //Si utilisateur pas connecté, on le redirige vers le formulaire
    if(!$this->isLogged())
    {
      header ('Location: /portfolio/login');
    }
  }

  //Accueil de l'administration
  public function index():void
  {

    $projetRepository = new ProjetRepository();

    $this->view('auth/admin.php',[
      'projects' => $projetRepository->findAll()
    ]);
  }

    //Nouveau Projet

  public function add():void 
  {
    $error = null;
    $success = null;

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      //Nettoyage des donées
      $title = htmlspecialchars(strip_tags($_POST['title']));
      $description = htmlspecialchars(strip_tags($_POST['description']));

      //Verifie si tout est bien rempli
      if(
        !empty($title) && 
        !empty($description) && 
        $_FILES['preview']['error']=== UPLOAD_ERR_OK
        )
      {

        //upload de l'image de preview
        $uploadService = new UploadService();
        $preview = $uploadService->upload($_FILES['preview']);

        if($preview)
        {
          //Date du jour
          $date = new \DateTime();

          // Créer un objet avec l'entité "Projet"
          $projet = new Projet();
          $projet->setTitle($title);
          $projet->setDescription($description);
          $projet->setPreview($preview);
          $projet->setCreatedAt($date->format('Y-m-d H:i:s'));
          $projet->setUpdatedAt($date->format('Y-m-d H:i:s'));

          $projetRepository = new ProjetRepository();
          $projetRepository->add($projet);

          $success = 'Votre nouveau projet est enregistré';
        }else 
        {
          $error = 'Le fichier est invalide';
        }
      }else 
      {
        $error = 'Tous les champs sont obligatoires';
      }
    }
    $this->view('auth/projet/add.php', [
      'error' => $error,
      'success' => $success
    ]);
  }
  /**
   * Edition d'un article
   */

  public function edit():void
  {
    //si l'id n'existe pas ou est vide, redirection vers l'administration
    if(empty($_GET['id'])){
      header('Location: /portfolio/admin');
      exit;
    }

    $projetRepository = new ProjetRepository();
    $projet = $projetRepository->find($_GET['id']);

    //Si aucun projet avec cet ID
    if(!$projet){
      header('Location: /portfolio/admin');
      exit;
    }



    //Si le formulaire est soumis
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      //Nettoyage des donées
      $title = htmlspecialchars(strip_tags($_POST['title']));
      $description = htmlspecialchars(strip_tags($_POST['description']));

      //Verifie si tout est bien rempli
      if(
        !empty($title) && 
        !empty($description) 
        )
      {
        //Sauvegarde le nom actuel de l'image de preview
        $preview = $projet->getPreview();
        // Si une image est fourni, on l'upload
        if($_FILES['preview']['error'] === UPLOAD_ERR_OK){
          //upload de l'image de preview
          $uploadService = new UploadService();
          $preview = $uploadService->upload($_FILES['preview'], $preview);
        }

      if($preview){
        //Date du jour
        $date = new \DateTime();

        // Modifie l'entité Projet
        $projet->setTitle($title);
        $projet->setDescription($description);
        $projet->setPreview($preview);
        $projet->setUpdatedAt($date->format('Y/m/d'))  ;      

        $projetRepository = new ProjetRepository();
        $projetRepository->edit($projet);

        $success = 'Votre nouveau projet est enregistré';

      } else{
        $error = 'Le fichier est invalide';
      }

      }else 
      {
        $error = 'Tous les champs sont obligatoires';
      }
    }

    $this->view('auth/projet/edit.php',[
      'projet' => $projet,
      'error' => $error ?? null, //equivaut à: $error !==null ? $error : null
      'success' => $success ?? null //Coalescence des null (Nullish coalescing operator)
    ]);
  }
  /**
   * Suppresion
   */
  public function delete() : void {
       //si l'id n'existe pas ou est vide, redirection vers l'administration
       if(empty($_GET['id'])){
        header('Location: /portfolio/admin');
        exit;
      }
  
      $projetRepository = new ProjetRepository();
      $projet = $projetRepository->find($_GET['id']);
  
      //Si aucun projet avec cet ID
      if(!$projet){
        header('Location: /portfolio/admin');
        exit;
      }

      //Suppression de l'id en BDD
      $projetRepository = new ProjetRepository();
      $projetRepository->delete($projet);

      //Supprime l'image du projet
      unlink($projet->getFolderPreview());

      header('Location: /portfolio/admin?success=Votre projet a bien été supprimé');
  }
}