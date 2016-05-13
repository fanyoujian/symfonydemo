<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
// use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Util;
use AppBundle\CommonController;

class DefaultController extends CommonController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        if(empty(Util::valiedSession($request)))
        {
            return $this->redirect($this->generateUrl('login_index'), 301);
        }
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
}
