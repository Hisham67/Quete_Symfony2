<?php
/**
 * Created by PhpStorm.
 * User: hisha
 * Date: 08/11/18
 * Time: 11:53
 */
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/",name="homepage")
     */
    public function index()
    {

        return $this->render('home/home.html.twig');

    }
}

