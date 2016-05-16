<?php

namespace Acme\DemoBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class RandomController extends Controller
{
	/**
     * @Route("/index")
     */
    public function indexAction()
    {
    	echo '99';exit;
    }
    /**
     * @Route("/blog/{limit}")
     */
    public function randomAction($limit)
    {
    	$number = rand(1, $limit);

        echo $number;exit;

        return $this->render(
            'AcmeDemoBundle:Random:index.html.twig',
            array('number' => $number)
        );
    }
    /**
     * @Route("/hello")
     */
    public function helloAction()
    {
    	echo 'd';exit;
    	return new Response('Hello world!');
    }
}
