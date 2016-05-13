<?php
 
// src/AppBundle/Controller/NewsController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use AppBundle\Entity\Users;

 
/**
 * @Route("/news")
 */
class NewsController extends Controller
{


    /**
     * @Route("/index",name="news_index")
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();

        $login = $session->get('login');
        if(empty($login))
        {
            return $this->redirect($this->generateUrl('login_index'), 301);
        }


    	// $user = new Users();
	    // $user->setName('A Foo Bar');
	   
	    // $em = $this->getDoctrine()->getManager();

	    // $em->persist($user);
	    // $em->flush();
	    // exit;
        return $this->render('news/index.html.twig',['news'=>'ddd word']);
    }
    /**
     * @Route("/create");
     */
    public function createAction()
    {
        return $this->render('news/create.html.twig');
    }
    /**
     * @Route("/edit");
     */
    public function editAction()
    {
        return $this->render('news/edit.html.twig');
    }
}