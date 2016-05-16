<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/roles")
 */
class RolesController extends Controller
{
    /**
     * @Route("/index")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()
        ->getRepository('AppBundle:Roles');

        //查询所有产品
        $roles=$repository->findAll();

        return $this->render('AppBundle:Roles:index.html.twig', array(
            // ...
            'roles'=>$roles
        ));
    }


    /**
     * @Route("/edit")
     */
    public function editAction()
    {
        return $this->render('AppBundle:Roles:edit.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/update")
     */
    public function updateAction()
    {
        return $this->render('AppBundle:Roles:update.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/create")
     */
    public function createAction()
    {
        return $this->render('AppBundle:Roles:store.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/store")
     */
    public function storeAction()
    {
        return $this->render('AppBundle:Roles:store.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/delete")
     */
    public function deleteAction()
    {
        return $this->render('AppBundle:Roles:delete.html.twig', array(
            // ...
        ));
    }

}
