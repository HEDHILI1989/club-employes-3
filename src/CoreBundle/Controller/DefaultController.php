<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/aa")
     */
    public function indexAction()
    {
        return $this->render('CoreBundle:Default:index.html.twig');
    }
}
