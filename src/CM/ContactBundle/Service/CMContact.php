<?php
namespace CM\ContactBundle\Service;

use CM\ContactBundle\Entity\Contact;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormBuilder;

class CMContact
{
    private $em;
    /**
     * CM constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function addContact(Contact $contact, $formAddContact) {
        $contact->setNom($formAddContact['nom']->getData());
        $contact->setPrenom($formAddContact['prenom']->getData());
        $contact->setEmail($formAddContact['email']->getData());
        $contact->setBirthdate(\DateTime::createFromFormat('d/m/Y', $formAddContact['birthdate']->getData()));
        $contact->setAdresse($formAddContact['adresse']->getData());
        $contact->setPostal($formAddContact['postal']->getData());
        $contact->setVille($formAddContact['ville']->getData());
        $contact->setTelephone($formAddContact['telephone']->getData());
        $contact->setWebSite($formAddContact['webSite']->getData());
        $this->em->persist($contact);
        $this->em->flush();
    }

    public function editContact(Contact $contact, $formEditContact) {
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
        $this->em->persist($contact);
        $this->em->flush();
    }
}