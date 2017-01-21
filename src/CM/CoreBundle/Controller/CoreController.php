<?php

namespace CM\CoreBundle\Controller;

use CM\ContactBundle\Entity\Contact;
use CM\ContactBundle\Form\Type\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    public function indexAction()
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            return $this->render('CMCoreBundle:membres:accueil.html.twig');
        }
        return $this->redirectToRoute('fos_user_security_login');
    }

    public function addAction()
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            $contact = new Contact();
            $formAddContact = $this->createForm(new ContactType(), $contact);
            return $this->render('CMCoreBundle:membres:ajouter.html.twig', array('formAddContact' => $formAddContact->createView()));
        }
        return $this->redirectToRoute('cm_core_homepage');
    }

    public function saveAddAction()
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            // Ajout en BDD d'un contact
        }
        // puis redirection
        return $this->redirectToRoute('cm_core_homepage');
    }

    public function editAction($idContact)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            // Recuperation des informations du contact a modifier et affichage dans le formulaire
            return $this->render('CMCoreBundle:membres:modifier.html.twig');
        }
        return $this->redirectToRoute('cm_core_homepage');
    }

    public function saveEditAction($idContact)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            // Enregistrement des modifications sur un contact
        }
        // puis redirection
        return $this->redirectToRoute('cm_core_homepage');
    }

    public function deleteAction($idContact)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            // Suppression d'un contact
        }
        // puis redirection
        return $this->redirectToRoute('cm_core_homepage');
    }
}
