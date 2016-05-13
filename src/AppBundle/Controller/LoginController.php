<?php


namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
/**
 * @Route("/login");
 */
class LoginController extends Controller
{
    /**
     * @Route("/index",name="login_index")
     */
    public function indexAction(Request $request)
    {
      
        // replace this example code with whatever you need
        return $this->render('login.html.twig');
    }
    /**
     * @Route("/login")
     */
    public function loginAction(Request $request)
    {

        // var_dump($request->request);

        $email = $request->request->get('email');

        $password = $request->request->get('password');

        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('AppBundle:Users');

        //         $repository->find($id);
        // $repository->findAll();
        // $repository->findOneByName(‘Foo’);
        // $repository->findAllOrderedByName();
        $user = $repository->findOneBy(array('name'=>$email,'password'=>$password));
        if($user)
        {
            $session = $request->getSession();

            $session->set('login',$user->getId());
            // echo $this->generateUrl('homepage');

            return $this->redirect($this->generateUrl('news_index'), 301);


            // return $this->redirect($this->generateUrl('news/index'), 301);
            // return $this->redirectToRoute('news/index', array(), 301);
            // return new RedirectResponse($this->generateUrl('/news/index'));
            // $this->redirect('/news/index');
            // return $this->render('/news/index.html.twig');
        }
        return $this->redirect($this->generateUrl('login_index'), 301);
    }
}
