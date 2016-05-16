<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProjectsController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppBundle:Projects:index.html.twig', array(
            // ...
        ));
    }

}
