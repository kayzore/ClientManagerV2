<?php

namespace CM\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CMCoreBundle:Default:index.html.twig');
    }
}
