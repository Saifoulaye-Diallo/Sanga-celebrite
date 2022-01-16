<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Faker;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ArticleRepository $artrepo,CategoryRepository $catrepo): Response
    {
        $articles = $artrepo->findAll();
        $categories = $catrepo->findAll();
        return $this->render('home/index.html.twig', [
            'articles' => $articles,
            'categories' => $categories
        ]);
    }

    #[Route('/article/{id}', name:'show')]
    public function show(Article $article): Response
    {
       if(!$article)
       {
           return $this->redirectToRoute('home');
       }
        return $this->render('home/show.html.twig', [
            'article' => $article,
        ]);
    }
    
    #[Route('/showArticle/{id}', name:'show_article')]
    public function showArticle(?Category $category,CategoryRepository $catrepo): Response
    {

       if($category)
       {
           $articles = $category->getArticles()->getValues();
       }else{
            return $this->redirectToRoute('home');
       }

       $categories = $catrepo->findAll();
        return $this->render('home/showArticle.html.twig', [
            'articles' => $articles,
            'categories' => $categories
        ]);
    }
}
