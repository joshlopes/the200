<?php

namespace App\Controller\Front;

use App\View\Homepage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller
{
    /**
     * @Route("/", name="app_front_homepage")
     *
     * @param Homepage $homepage
     *
     * @return Response
     */
    public function indexAction(Homepage $homepage): Response
    {
        return $this->render('/front/homepage.html.twig', ['homepage' => $homepage]);
    }

}
