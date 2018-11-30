<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    /**
     * Show all row from article's entity
     *
     * @Route("/category/form/form", name="category_form")
     * @return Response A response instance
     */
    public function form(Request $request) : Response
    {

        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($category);
            $manager->flush();
            return $this->redirectToRoute('category_show', ['id' => $category ->getId()]);
        }
        return $this->render(
            'category/index.html.twig', [
                'category' => $category,
                'form' => $form->createView(),
            ]
        );
    }



    /**
     * @Route("/category/{id}", name="category_show")
     */

    public function show(Category $category) : Response
    {

       return $this->render('category/category.html.twig', ['category'=>$category]);
    }
}
