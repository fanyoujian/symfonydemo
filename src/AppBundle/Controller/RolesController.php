<?php

namespace AppBundle\Controller;

// use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\CommonController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use AppBundle\Entity\Roles;

/**
 * @Route("/roles")
 */
class RolesController extends CommonController
{
    /**
     * @Route("/index",name="roles_index")
     */
    public function indexAction(Request $request)
    {
        // $repository = $this->getDoctrine()
        // ->getRepository('AppBundle:Roles');

        // //查询所有产品
        // $roles=$repository->findAll();

        // return $this->render('AppBundle:Roles:index.html.twig', array(
        //     // ...
        //     'roles'=>$roles
        // ));
        // 
        $em = $this->getDoctrine()->getManager();
 
        $qb = $em->getRepository('AppBundle:Roles')->createQueryBuilder('n');
     
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($qb, $request->query->getInt('page', 1),3);
     
        return $this->render('AppBundle:Roles:index.html.twig', [
            'pagination' => $pagination,
        ]);


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
    public function storeAction(Request $request)
    {

        $title = $request->request->get('name');


        $roles = new Roles();
        $roles->setName($title);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($roles);
        $em->flush();

        return $this->redirect($this->generateUrl('roles_index'), 301);
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
