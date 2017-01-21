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
                $contactService = $this->container->get('cm_contact.contact');
                $contactService->addContact($contact, $formAddContact);
                return $this->redirectToRoute('cm_core_homepage');
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
                $contactService = $this->container->get('cm_contact.contact');
                $contactService->editContact($contact, $formEditContact);
                return $this->redirectToRoute('cm_core_homepage');
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
            $em = $this->getDoctrine()->getManager();
            $contact = $em->getRepository('CMContactBundle:Contact')->findOneBy(array('id' => $idContact));
            $em->remove($contact);
            $em->flush();
        }
        return $this->redirectToRoute('cm_core_homepage');
    }
}
