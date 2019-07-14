<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Employe;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Form\EmployeType;
use App\Repository\EmployeRepository;
use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;

class SonatelController extends AbstractController
{
    /**
     *@Route("/", name="nouv_employe")
     *@Route("/sonatel/{id}/Employer/Modifier", name="Modif_employe")
     *@Route("/sonatel/Ajouter/Employer/{ouvrir}", name="Form_employe")
     */
    public function employe($ouvrir=false,Employe $employe=null,EmployeRepository $repo,Request $requet, ObjectManager $manager){
        if(!$employe){
            $employe=new Employe();
        }else{
            $ouvrir=true;
        }
        $form=$this->createForm(EmployeType::class,$employe);
        $lesEmployes=$repo->findAll();

        $form->handleRequest($requet);//analyse de la requette (recu apres envoi du formulaire)
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($employe);
            $manager->flush();
            return $this->redirectToRoute("nouv_employe",['employes'=>$lesEmployes]);
        }

        return $this->render('sonatel/addEmployer.html.twig',[
            'form'=>$form->createView(),
            'employes'=>$lesEmployes,
            'ouvrir'=>$ouvrir
        ]);
    }
    /**
     *@Route("/sonatel/Nouveau/Service", name="nouv_service")
     *@Route("/sonatel/{id}/Service/Modifier", name="Modif_service")
     *@Route("/sonatel/Ajouter/Service/{ouvrir}", name="Form_service")
     */
    public function service($ouvrir=false,Service $service=null,ServiceRepository $repo,Request $requet, ObjectManager $manager){
        if(!$service){
            $service=new Service();
        }else{
            $ouvrir=true;
        }
        $form=$this->createForm(ServiceType::class,$service);
        $lesServices=$repo->findAll();

        $form->handleRequest($requet);//analyse de la requette (recu apres envoi du formulaire)
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($service);
            $manager->flush();
            return $this->redirectToRoute("nouv_service",['services'=>$lesServices]);
        }

        return $this->render('sonatel/addService.html.twig',[
            'form'=>$form->createView(),
            'services'=>$lesServices,
            'ouvrir'=>$ouvrir
        ]);
    }
    /**
     *@Route("/sonatel/{id}/Employer/Suprimer",name="Sup_employe")
     *@Route("/sonatel/{id}/Service/Suprimer",name="Sup_service")
     */
    public function deleteEmploye(Employe $employe=null,EmployeRepository $repoEmp,Service $service=null,ServiceRepository $repoServ,ObjectManager $manager){
        if($employe){
            $lesEmployes=$repoEmp->findAll();
            $manager->remove($employe);
        }
        if($service){
            $manager->remove($service);
            $lesEmployes=$repoServ->findAll();
        }
        $manager->flush();
        
        if($employe) return $this->redirectToRoute("nouv_employe",['employes'=>$lesEmployes]);
        if($service) return $this->redirectToRoute("nouv_service",['services'=>$lesEmployes]);
    }
    /**
     * @Route("/sonatel/{id}/Service/Lister", name="Lister")
     */
    public function listerService(Service $service){
        $EmployesServices=$service->getEmployes();
        return $this->render("sonatel/listerEmployeService.html.twig",[
            'EmployesServices'=>$EmployesServices
        ]);
    }
}
