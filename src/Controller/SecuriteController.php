<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecuriteController extends AbstractController{
    /**
     * @Route("/connexion", name="securite")
     */
    public function login(Request $request,AuthenticationUtils $utils)
    {   $error=null;
        if($utils->getLastAuthenticationError()){//s il y a une erreur lors de l authentification getLastAuthenticationError() renvoi le type d erreur en anglais...
            $error="Erreur sur l'un des paramètres !!";
        }
        $lastUserName=$utils->getLastUsername();
        return $this->render('securite/login.html.twig',[
            'error'=>$error,
            'lastUserName'=>$lastUserName
        ]);
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
