<?php

namespace App\Controller;
use App\Entity\User;

abstract class AbstractController{

  // Deconnexion de l'utilisateur
  public function logout():void 
  {
    unset($_SESSION['user']);
    header ('Location: portfolio/');
  }

  //Verifie si l'utilisateur est connecté
  protected function isLogged():bool
  {
    //Je verifie que la session nommée "user" existe bien et que celle-ci a été instancié avec la classe User
    return isset($_SESSION['user']) && $_SESSION['user'] instanceof User;
    
  }

  /**
   * Permet d'afficher une vue
   */
  protected function view(string $path, array $vars=[]):void{

    $vars['isLogged'] = $this->isLogged();
    
    /**
     * Extrait les clés comme des variables et affectent comme valeur, la valeur de la clé du tableau 
     */
    extract($vars);

    //Si le template exite, on l'affiche
    if (file_exists("../templates/$path")){
      require_once "../templates/$path";
      return;
    }

    throw new \Exception("Le template \"$path\" n'existe pas");

  }
}