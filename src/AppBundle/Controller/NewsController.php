<?php
 
// src/AppBundle/Controller/NewsController.php
namespace AppBundle\Controller;
 
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Users;
 
/**
 * @Route("/news")
 */
class NewsController extends Controller
{
    /**
     * @Route("/index")
     */
    public function indexAction()
    {

    	// $user = new Users();
	    // $user->setName('A Foo Bar');
	   
	    // $em = $this->getDoctrine()->getManager();

	    // $em->persist($user);
	    // $em->flush();
	    // exit;
        return $this->render('news/index.html.twig',['news'=>'ddd word']);
    }
}