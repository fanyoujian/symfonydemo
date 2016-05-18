<?php
 
// src/AppBundle/Controller/NewsController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
// use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use AppBundle\Entity\Users;

use AppBundle\Util;
use AppBundle\CommonController;
use AppBundle\Entity\News;

 
/**
 * @Route("/news")
 */
class NewsController extends CommonController
{


    /**
     * @Route("/index",name="news_index")
     */
    public function indexAction(Request $request)
    {
       
        if(empty(Util::valiedSession($request)))
        {
            return $this->redirect($this->generateUrl('login_index'), 301);
        }

    	// $user = new Users();
	    // $user->setName('A Foo Bar');
	   

       $repository = $this->getDoctrine()
        ->getRepository('AppBundle:News');


        // $product=$repository->find($id);

        //动态方法名基于列值查找
        // $product=$repository->findOneById($id);
        // $product=$repository->findOneByName('foo');

        //查询所有产品
        $news=$repository->findAll();
        //基于任意列值查找一组产品
        // $products = $repository->findByPrice(19.99);



	    // $em = $this->getDoctrine()->getManager();

	    // $em->persist($user);
	    // $em->flush();
	    // exit;
        return $this->render('news/index.html.twig',['newses'=>$news]);
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

    /**
     * @Route("/store",name="news_store")
     */
    public function storeAction(Request $request)
    {
        $bannertypeid = $request->request->get('bannertypeid');
        $title = $request->request->get('title');

        $imgurl = '';
        $extension = '';
        if(!empty($_FILES["file"]['name']))
        {

            $imgurl = Util::filecrate();
            $imginfo = getimagesize($imgurl);

            // $width = $imginfo[0];
            // $hight= $imginfo[1];
            $type = $imginfo[2];

            // if($width!=414){
            //     return redirect()->back()->withErrors(['msg'=>'宽度超多限制,请上传414 ＊ 140 的图片'],'store');
            // }
            // if($hight!=140){
            //   return redirect()->back()->withErrors(['msg'=>'高度超多限制,请上传414 ＊ 140 的图片'],'store');
            // }
            $flag=  in_array($type, ['2','3']);

            if(!$flag)
            {
               echo 'no flag';exit;
            }

            $info = pathinfo($imgurl);


            $extension = strtolower($info['extension']);

            $newfile='uploads/news/icon'.'/'.md5($_FILES["file"]['name']).'.'.$extension;
            rename($imgurl, $newfile);
            $imgurl = $newfile;
        }

        $news = new News();
        $news->setTitle($title);
        $news->setBannerUrl($imgurl);


        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($news);
        $em->flush();
        return $this->redirect($this->generateUrl('news_index'), 301);

    }
}