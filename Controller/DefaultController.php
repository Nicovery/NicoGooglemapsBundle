<?php

namespace Nico\GooglemapsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('NicoGooglemapsBundle:Default:index.html.twig', array('name' => $name));
    }
}
