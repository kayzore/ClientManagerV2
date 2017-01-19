<?php

namespace CM\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    public function indexAction()
    {
        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            return $this->render('CMCoreBundle:membres:accueil.html.twig');
        }
        return $this->render('CMCoreBundle:visiteurs:accueil.html.twig');
    }

    public function addAction()
    {
        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            return $this->render('CMCoreBundle:membres:ajouter.html.twig');
        }
        $this->redirectToRoute('cm_core_homepage');
    }

    public function saveAddAction()
    {
        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            return $this->render('CMCoreBundle:membres:ajouter.html.twig');
        }
        $this->redirectToRoute('cm_core_homepage');
        // Ajout en BDD d'un contact puis redirection
        $this->redirectToRoute('cm_core_homepage');
    }

    public function editAction($idContact)
    {
        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            // Recuperation des informations du contact a modifier et affichage dans le formulaire
            return $this->render('CMCoreBundle:membres:modifier.html.twig');
        }
        $this->redirectToRoute('cm_core_homepage');
    }

    public function saveEditAction($idContact)
    {
        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            // Enregistrement des modifications sur un contact puis redirection
            $this->redirectToRoute('cm_core_homepage');
        }
        $this->redirectToRoute('cm_core_homepage');
    }

    public function deleteAction($idContact)
    {
        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            // Suppression d'un contact puis redirection
            $this->redirectToRoute('cm_core_homepage');
        }
        $this->redirectToRoute('cm_core_homepage');
    }
}
