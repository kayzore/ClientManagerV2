<?php

namespace CM\ContactBundle\Controller;

use CM\ContactBundle\Entity\Contact;
use CM\ContactBundle\Form\Type\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    public function getFormAction($contact)
    {
        if($contact === null) {
            $contact = new Contact();
        }
        $form = $this->createForm(new ContactType(), $contact);
        return $form;
    }
}
