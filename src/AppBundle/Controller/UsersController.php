<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use AppBundle\Entity\Users;
use AppBundle\Form\UsersType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @Route("/users")
 */
class UsersController extends Controller
{
    /**
     * @Route("/index",name="user_index")
     */
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
 
        $qb = $em->getRepository('AppBundle:Users')->createQueryBuilder('n');
     
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($qb, $request->query->getInt('page', 1),3);
     
        return $this->render('AppBundle:Users:index.html.twig', [
            'pagination' => $pagination,
        ]);


    }

    /**
     * @Route("/edit")
     */
    public function editAction()
    {
        return $this->render('AppBundle:Users:edit.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/update")
     */
    public function updateAction()
    {
        return $this->render('AppBundle:Users:update.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/create");
     * @return [type] [description]
     */
    public function createAction(Request $request)
    {



        $users = new Users();

        


        //第一种方式

        $form = $this->createFormBuilder()
        ->add('name', TextType::class)
        // or ->add('name', Symfony\Component\Form\Extension\Core\Type\TextType)
        ->add('password', TextType::class)
        ->add('save',SubmitType::class)
        // or ->add('age', Symfony\Component\Form\Extension\Core\Type\IntegerType)
        ->getForm();


        // 第二种f

        // $form = $this->createForm(new UsersType(),$users);



        if ($request->getMethod()=='POST')
        {
            // $form->submit($request);


            $form->handleRequest($request);
            // $form->submit($request->request->all());

            if($form->isValid()){
                $em=$this->getDoctrine()->getManager();
                $users->setName($request->request->get('form')['name']);
                $users->setPassword($request->request->get('form')['password']);
                $em->persist($users);
                $em->flush();
                return $this->redirect($this->generateUrl('user_index'), 301);
            }            
        }
      
        return $this->render('AppBundle:Users:store.html.twig', array(
            // ...
            'form' => $form->createView(),
        ));
    }
    /**
     * @Route("/store")
     */
    public function storeAction()
    {
        return $this->render('AppBundle:Users:store.html.twig', array(
            // ...
        ));
    }

}
