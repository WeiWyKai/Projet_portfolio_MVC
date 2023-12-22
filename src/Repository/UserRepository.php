<?php

namespace App\Repository;

use App\Entity\User;
use Core\Database;

/**
 * UserRepository.php
 */
class UserRepository extends Database
{
    private $instance;
    
    public function __construct()
    {
        $this->instance = self::getInstance();
    }

    /**
     * Insertion en base de données
     */
    public function add(User $user): User
    {
        $query = $this->instance->prepare("

        INSERT INTO users (username, password)
        VALUES (:username, :password)
        ");

        $query->bindValue(':username', $user->getUserName());
        $query->bindValue(':password', $user->getPassword());
        $query->execute();

        //Recupere l'ID nouvellement créé
        $id=$this->instance->lastInsertId();

        //Ajout de l'ID à mon user
        $user->setId($id);

        //Retourne notre objet muni d'un ID
        return $user;
    }

    //Selectionne un enregistrement selon un identifiant
    public function findByUsername(string $username):User|bool{

        $query= $this->instance->prepare("
            SELECT * FROM users WHERE username = :username;
        ");
        $query->bindValue(':username', $username);
        $query->execute();

        $user= $query->fetch();

        if($user){
            $objectUser = new User();
            $objectUser->setId($user->id);
            $objectUser->setUsername($user->username);
            $objectUser->setPassword($user->password);

            return $objectUser;
        }
        return false;
    }
}