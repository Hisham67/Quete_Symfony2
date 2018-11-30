<?php
// src/Controller/BlogController.php
namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Form\ArticleSearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{

    /**
     * Getting a article with a formatted slug for title
     *
     * @param string $slug The slugger
     *
     * @Route("/{slug<^[a-z0-9-]+$>}",
     *     defaults={"slug" = null},
     *     name="blog_show")
     *  @return Response A response instance
     */
    public function show($slug) : Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find an article in article\'s table.');
        }

        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);

        if (!$article) {
            throw $this->createNotFoundException(
                'No article with '.$slug.' title, found in article\'s table.'
            );
        }

        return $this->render(
            'blog/show.html.twig',
            [
                'article' => $article,
                'slug' => $slug,
            ]
        );
    }
    /**
     * Show all row from article's entity
     * @Route("/blog/index", name="blog_index")
     * @return Response A response instance
     */

    public function index(Request $request) : Response
    {
        $form = $this->createForm(ArticleSearchType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $data = $form->getData();

        }
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }

        return $this->render(
            'blog/index.html.twig',
            ['articles' => $articles,
            'form' => $form->createView()
        ]);

    }

    /**
     *
     *
     * @param string $category the slugger
     *
     * @Route("blog/category/{category}", name="blog_show_category").
     * @return Response A response instance
     */
    public function showByCategory(string $category) : Response
    {
        $categoryRepository = $this->getDoctrine()
            ->getRepository(Category::class);
        $oneCategory = $categoryRepository->findOneByName($category);

        $articleRepository = $this->getDoctrine()
            ->getRepository(Article::class);
        $articles = $articleRepository->findBy(
            ['category'=>$oneCategory],
            ['id'=>'DESC'],
            3);
        return $this->render(
            'blog/category.html.twig',
            [
                'articles' => $articles,
                'category' => $oneCategory,
            ]);
    }

    /**
     *
     *
     * @param string $category the slugger
     *
     * @Route("blog/category/{category}/all", name="blog_show_category_all").
     * @return Response A response instance
     */

    public function showAllByCategory() : Response
    {
        $categoryRepository = $this->getDoctrine()
            ->getRepository(Category::class);


        $categories=$categoryRepository->findAll();

        return $this->render(
            'blog/allcategory.html.twig',
            [
                'categories' => $categories,
            ]);
    }
}