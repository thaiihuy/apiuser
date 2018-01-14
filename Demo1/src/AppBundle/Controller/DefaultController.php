<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/login")
     * @Method("GET")
     */
    public function getLogin()
    {
        return $this->render("login/login.html.twig");
    }
    /**
     * @Route("/login")
     * @Method("POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function checkLogin(Request $request)
    {
        $us=new User();
        $us->username='admin';
        $us->pass='123';
//        return $this->json($us);
        $data = json_decode($request->getContent(), true);
        if($us->username==$data['username'] && $us->pass==$data['pass'])
        {
            return $this->json($us);
        }
        else{
            return $this->json("hhhh");
        }


   }
}
