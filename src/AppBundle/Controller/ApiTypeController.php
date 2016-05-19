<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use AppBundle\Entity\ApiType;
use AppBundle\Form\ApiTypeType;

/**
 * @Route("/apitype");
 */
class ApiTypeController extends Controller
{
    /**
     * @Route("/index",name="apitype_index")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
 
        $qb = $em->getRepository('AppBundle:ApiType')->createQueryBuilder('n');
     
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($qb, $request->query->getInt('page', 1),3);

        return $this->render('AppBundle:ApiType:index.html.twig', array(
            'pagination' => $pagination,
        ));
    }

    /**
     * @Route("/store")
     */
    public function storeAction(Request $request)
    {
        $apitype = new ApiType();

        $form = $this->createForm(ApiTypeType::class, $apitype);

        if ($request->getMethod()=='POST')
        {

            $form->handleRequest($request);

            if($form->isValid()){

                $em=$this->getDoctrine()->getManager();
                $em->persist($apitype);
                $em->flush();

                return $this->redirect($this->generateUrl('apitype_index'), 301);
            }
        }
        return $this->render('AppBundle:ApiType:store.html.twig', array(
            // ...
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/delete")
     */
    public function deleteAction()
    {
        return $this->render('AppBundle:ApiType:delete.html.twig', array(
            // ...
        ));
    }

}
