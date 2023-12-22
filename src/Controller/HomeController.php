<?php

namespace App\Controller;

use App\Repository\ProjetRepository;
use PHPMailer\PHPMailer\PHPMailer;

class HomeController extends AbstractController{

  /**
   * Page d'accueil
   */
  public function index():void{

    $projetRepository = new ProjetRepository();
    // require_once '../templates/home/index.php';
    $this->view('home/index.php',[
      'projects' => $projetRepository->findAll()
    ]);
  }

  /**
   * détail d'un projet
   */
  public function details(): void
    {
      $projetRepository = new ProjetRepository();
      $project = $projetRepository->find($_GET['id']);

      // Erreur 404 ?
      if (!$project) {
          header('Location:/portfolio/404');
          exit;
      }

      $this->view('home/details.php', [
          'project' => $project
      ]);
    }


  /**
   * page de test
   */

  public function test():void{

    
    // L'appel du template se situe toujours en derniere ligne de la methode
    require_once '../templates/home/test.php';
  }

  /**
   * page de contact
   */

  public function contact():void{

    $error=null;
    $success=null;

    //Si le formulaire est envoyé...
    if($_SERVER['REQUEST_METHOD']==='POST'){

      // Si une méthode POST est reçue
      $name = htmlspecialchars(strip_tags($_POST['name']));
      $email = htmlspecialchars(strip_tags($_POST['email']));
      $message = htmlspecialchars(strip_tags($_POST['message']));

      //Verifie si les champs ne sont pas vides
      if(!empty($name) && !empty($email) && !empty($message)){
        
        //Verifie si l'email est valide
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){

        // Connecter au SMTP de MailTrap
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = $_ENV['MAIL_SMTP'];
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = $_ENV['MAIL_PORT'];
        $phpmailer->Username = $_ENV['MAIL_USER'];
        $phpmailer->Password = $_ENV['MAIL_PASS'];

        // Envoi du mail
        $phpmailer->setFrom($email, $name); // Expéditeur
        $phpmailer->addAddress($_ENV['USER_EMAIL'], $_ENV['USER_NAME']); // Destinataire
        $phpmailer->Subject = 'Message du formulaire de contact';
        $phpmailer->Body = $message;

          if($phpmailer-> send()){

            $success = 'Votre message a bien été envoyé';

          } else{

            // $error = "Votre message n'a pu être envoyé. Veuillez ré-essayer !";
            $error = $phpmailer->ErrorInfo;
          
          }

        } else{
          $error = 'Votre email n\'est pas valide';
        } 
          
      } else{
        $error='Tous les champs sont obligatoires';
      }
    }

    // require_once '../templates/home/contact.php';
    $this->view('home/contact.php',[
      'error' =>$error,
      'success' =>$success
    ]);
     
  }
}
