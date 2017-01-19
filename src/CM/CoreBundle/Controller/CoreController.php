<?php

namespace CM\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    public function indexAction()
    {
        return $this->render('CMCoreBundle:membres:accueil.html.twig');
    }

    public function addAction()
    {
        return $this->render('CMCoreBundle:membres:ajouter.html.twig');
    }

    public function saveAddAction()
    {
        // Ajout en BDD d'un contact puis redirection
        $this->redirectToRoute('cm_core_homepage');
    }

    public function editAction($idContact)
    {
        // Recuperation des informations du contact a modifier et affichage dans le formulaire
        return $this->render('CMCoreBundle:membres:modifier.html.twig');
    }

    public function saveEditAction($idContact)
    {
        // Enregistrement des modifications sur un contact puis redirection
        $this->redirectToRoute('cm_core_homepage');
    }

    public function deleteAction($idContact)
    {
        // Suppression d'un contact puis redirection
        $this->redirectToRoute('cm_core_homepage');
    }
}
