<?php
// src/Controller/BlogController.php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
     * Matches /blog exactly
     * @Route("/blog/{page}", name="blog_list" , requirements={"page"="\d+"})
     */
    public function list($page = 1)
    {
        // render twig
    return $this->render('blog/index.html.twig', ['page'=>$page]);
    }

    /**
     * Matches /blog/*
     *
     * @Route("/blog/{slug}", name="blog_show" , requirements={"slug"="[a-z0-9-]+"})
     */
    public function show($slug ="article-sans-titre")
    {
       $slug = str_replace("-"," ",$slug);
       $slug = ucwords($slug);

        return $this->render('blog/index.html.twig', ['slug'=>$slug]);
    }

    /**
     * @Route("/blog/{page}", defaults={"page"=1})
     */

    public function index($page)
    {
        // ...
    }

}