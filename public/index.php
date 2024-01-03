<?php

// Chargement des dépendances PHP
require_once '../vendor/autoload.php';

//démarrage de la session
session_start();

// Chargement des variables d'environnements
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ .'/../');
$dotenv->load();

// Instancier notre routeur afin de rediriger notre utilisateur
$router = new Core\Router();

//Nos routes
//Accueil
$router->add('/portfolio', 'HomeController', 'index');

//Test
$router->add('/portfolio/test', 'HomeController', 'test');

//Formulaire de contact
$router->add('/portfolio/contact', 'HomeController', 'contact');

//Insertion de données d'essais
$router->add('/portfolio/fixture', 'FixtureController', 'index');

//Detail d'un projet
$router->add('/portfolio/projet/details', 'HomeController', 'details');

//Login
$router->add('/portfolio/login', 'AuthController', 'login');

//Logout
$router->add('/portfolio/logout', 'AuthController', 'logout');

//Accueil de l'administration
$router->add('/portfolio/admin','AdminController','index');

// Administration - Ajout d'un projet
$router->add('/portfolio/admin/new/project', 'AdminController', 'add');

// Administration - Edition d'un projet
$router->add('/portfolio/admin/edit/project', 'AdminController', 'edit');

// Administration - Suppression d'un projet
$router->add('/portfolio/admin/delete/project', 'AdminController', 'delete');

//erreur 404
$router->add('portfolio/404', 'ErrorController', 'error404');

//Dispatch
$router-> dispatch($_SERVER['REQUEST_URI']);