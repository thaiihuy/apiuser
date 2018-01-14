<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Category;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
/**
 * @Route("/category")
 */
class CategoryController extends Controller
{
    /**
     * @Route("/")
     * @Method("GET")
     */
    public function  listAction(){
        $res=$this->getDoctrine()->getRepository(Category::class);
        $category=$res->findAll();
//        $response = new Response(json_encode(compact('category')));
//        $response->headers->set('Content-Type', 'application/json');
//        return $response;
        return $this->render("category/category.html.twig",compact('category'));
    }

    /**
     * @Route("/detail/{id}")
     * @Method("GET")
     * @param $id
     * @return Response
     */
    public function detailAction($id){
        $res=$this->getDoctrine()->getRepository(Category::class);
        $category=$res->find($id);
        return $this->render(':category:detail.html.twig',compact('category'));
    }
    /**
     * @Route("/create")
     * @Method("GET")
     */
    public function getCreate()
    {
        return $this->render(':category:add.html.twig');
    }

    /**
     * @Route("/create")
     * @Method("POST")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        $category =new Category();
        $category->name=$request->request->get('name');
        $res=$this->getDoctrine()->getManager();
        $res->persist($category);
        $res->flush();
        return $this->redirect('/category');
    }
    /**
     * @Route("/edit/{id}")
     * @Method("GET")
     * @param $id
     * @return Response
     */
    public function getEdit($id){
        $res=$this->getDoctrine()->getRepository(Category::class);
        $category=$res->find($id);
        return $this->render(':category:edit.html.twig',compact('category'));

    }

    /**
     * @Route("/edit/{id}")
     * @Method("POST")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function postEdit(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $category=$em->getRepository('AppBundle:Category')->find($id);
        $category->name=$request->request->get('name');
        $em->flush();
        return $this->redirect('/category');
    }

    /**
     * @Route("/delete/{id}")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(int $id)
    {
        $em=$this->getDoctrine()->getManager();
        $category=$em->getRepository('AppBundle:Category')->find($id);
        $em->remove($category);
        $em->flush();
        return $this->redirect('/category');
    }
}