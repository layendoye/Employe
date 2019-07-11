<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SecuriteController extends AbstractController{
    /**
     * @Route("/connexion", name="securite")
     */
    public function index()
    {
        return $this->render('securite/index.html.twig');
    }
    /**
    *@Route("/deconnexion", name="security_logout")
    */
    public function logout(){}
    /*
    1- Creer une entite User 
    2- Aller dans aller dans config -> packages -> packages -> Security.yaml
    3- gerer l encodage
    4- gerer les providers
    5- gerer les form_login et form_logout
    6- Modifier l'entité en ajoutant implements UserInterface et les 3 dernieres methodes
     */
}
