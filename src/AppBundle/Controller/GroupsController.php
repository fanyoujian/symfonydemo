<?php
 
// src/AppBundle/Controller/GroupsController.php
namespace AppBundle\Controller;

use AppBundle\Util;
use AppBundle\CommonController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use AppBundle\Entity\Groups;

 
/**
 * @Route("/groups")
 */
class GroupsController extends CommonController
{


    /**
     * @Route("/index",name="groups_index")
     */
    public function indexAction(Request $request)
    {
       
        if(empty(Util::valiedSession($request)))
        {
            return $this->redirect($this->generateUrl('login_index'), 301);
        }


       $repository = $this->getDoctrine()
        ->getRepository('AppBundle:Groups');

        //查询所有产品
        $groups=$repository->findAll();

        return $this->render('groups/index.html.twig',['groups'=>$groups]);
    }
    /**
     * @Route("/create");
     */
    public function createAction()
    {
        return $this->render('groups/create.html.twig');
    }
    /**
     * @Route("/edit/{id}",name="group_edit");
     * 
     */
    public function editAction($id)
    {
        
        $repository = $this->getDoctrine()
        ->getRepository('AppBundle:Groups');


        try {
            $groups=$repository->find($id);

        } catch (Exception $e) {
            echo $e;
            exit;
        }
        
        return $this->render('groups/edit.html.twig',['groups'=>$groups]);
    }


    /**
     * @Route("/update",name="groups_update")
     */
    public function updateAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $groups = $em->getRepository('AppBundle:Groups')->find($request->request->get('id'));

        if (!$groups) {
            throw $this->createNotFoundException('No groups found for id '.$id);
        }

        $groups->setTitle($request->request->get('title'));
        $em->flush();

        return $this->redirect($this->generateUrl('groups_index'), 301); 
    }
    /**
     * @Route("/store",name="groups_store")
     */
    public function storeAction(Request $request)
    {

        $title = $request->request->get('title');

        $groups = new Groups();
        $groups->setTitle($title);
        $groups->setStatus(1);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($groups);
        $em->flush();
        return $this->redirect($this->generateUrl('groups_index'), 301);

    }
    /**
     * @Route("/delete/{id}",name="groups_delete")
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $groups = $em->getRepository('AppBundle:Groups')->find($id);

        if (!$groups) {
            throw $this->createNotFoundException('No groups found for id '.$id);
        }

        $em->remove($groups);
        $em->flush();
        return $this->redirect($this->generateUrl('groups_index'), 301);
    }
}