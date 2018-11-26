<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{id}", name="category_show")
     */

    public function show(Category $category) : Response
    {
        return $this->render('category/index.html.twig', ['category'=>$category]);
    }
}
