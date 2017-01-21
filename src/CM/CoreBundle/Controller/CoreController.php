<?php

namespace CM\CoreBundle\Controller;

use CM\ContactBundle\Entity\Contact;
use CM\ContactBundle\Form\Type\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CoreController extends Controller
{
    public function indexAction()
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            $em = $this->getDoctrine()->getManager();
            $listContact = $em->getRepository('CMContactBundle:Contact')->findAll();
            return $this->render('CMCoreBundle:membres:accueil.html.twig', array('listContact' => $listContact));
        }
        return $this->redirectToRoute('fos_user_security_login');
    }

    public function addAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            $contact = new Contact();
            $formAddContact = $this->createForm(new ContactType(), $contact);
            if ($formAddContact->handleRequest($request)->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $contact->setNom($formAddContact['nom']->getData());
                $contact->setPrenom($formAddContact['prenom']->getData());
                $contact->setEmail($formAddContact['email']->getData());
                $birthdate = \DateTime::createFromFormat('d/m/Y', $formAddContact['birthdate']->getData());
                $contact->setBirthdate($birthdate);
                $contact->setAdresse($formAddContact['adresse']->getData());
                $contact->setPostal($formAddContact['postal']->getData());
                $contact->setVille($formAddContact['ville']->getData());
                $contact->setTelephone($formAddContact['telephone']->getData());
                $contact->setWebSite($formAddContact['webSite']->getData());
                $em->persist($contact);
                $em->flush();
                return $this->redirect($this->generateUrl('cm_core_homepage'));
            }
            return $this->render('CMCoreBundle:membres:ajouter.html.twig', array('formAddContact' => $formAddContact->createView()));
        }
        return $this->redirectToRoute('cm_core_homepage');
    }

    public function editAction(Request $request, $idContact)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            // Recuperation des informations du contact a modifier et affichage dans le formulaire
            $em = $this->getDoctrine()->getManager();
            $contact = $em->getRepository('CMContactBundle:Contact')->findOneBy(array('id' => $idContact));
            $contactNew = new Contact();
            $formEditContact = $this->createForm(new ContactType(), $contactNew);
            if ($formEditContact->handleRequest($request)->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $contact->setNom($formEditContact['nom']->getData());
                $contact->setPrenom($formEditContact['prenom']->getData());
                $contact->setEmail($formEditContact['email']->getData());
                $birthdate = \DateTime::createFromFormat('d/m/Y', $formEditContact['birthdate']->getData());
                $contact->setBirthdate($birthdate);
                $contact->setAdresse($formEditContact['adresse']->getData());
                $contact->setPostal($formEditContact['postal']->getData());
                $contact->setVille($formEditContact['ville']->getData());
                $contact->setTelephone($formEditContact['telephone']->getData());
                $contact->setWebSite($formEditContact['webSite']->getData());
                $em->persist($contact);
                $em->flush();
                return $this->redirect($this->generateUrl('cm_core_homepage'));
            }
            return $this->render('CMCoreBundle:membres:modifier.html.twig', array(
                'formEditContact'   => $formEditContact->createView(),
                'contact'           => $contact
            ));
        }
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
