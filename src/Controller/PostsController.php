<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Entity\Posts;
use App\Entity\PostsByAuthors;
use App\Entity\Authors;

class PostsController extends Controller
{
    public function getPosts($min,$max) 
    {
        // znajdz posty od najnowszego do najstarszego
        $query=$this->getDoctrine()
        ->getRepository(Posts::class)->createQueryBuilder('p')
        ->select('p.id', 'p.date', 'p.topic')
        ->setFirstResult($min)
        ->setMaxResults($max)
        ->orderBy('p.date', 'DESC')
        ->getQuery();
        $posts = $query->execute();
        return $posts;
    }

    public function numberOfPosts()
    {
        // liczba postow
        $qcount = $this->getDoctrine()->getManager();
        $count = $qcount->createQuery(
        ' SELECT  count(p.id)
          FROM    App\Entity\Posts p
        ')
        ->getSingleScalarResult();
        return $count;
    }


    /**
     * @Route("/archives", name="archives")
     */
    public function archives()
    {
        $numberOfPosts=$this->numberOfPosts();
        $posts = $this->getPosts(0, $numberOfPosts);
        
        return $this->render('archives/archives.html.twig', [
            'posts' => $posts,
            'pageName' => 'archiwum',
        ]);
    }


    public function page()
    {
        // ilosc wynikow na stronie 
        $page=3;
        return $page;
    }

    /**
    * @Route("/", name="main")
    */
    public function index()
    {
        //liczba postów
        $numberOfPosts=$this->numberOfPosts();

        // liczba elementow na stronie
        $page=$this->page();
        $numberOfPages=ceil($numberOfPosts/$page);

        // znajdz posty od najnowszego do najstarszego
        $posts=$this->getPosts(0,$page);

        // znajdz autor postow 
        // $authors=$this->getAuthors();

        return $this->render('main/index.html.twig', [
            'posts'=> $posts,
            // 'authors'=> $authors,
            'pageName' => 'blog',
            'numberOfPages' => $numberOfPages,
        ]);
    }

    
    /**
     * @Route("/strona/{slug}", name="showPage")
     */
    public function showPage($slug)
    {
        $prevPage=$slug-1;
        $nextPage=$slug+1;

        //liczba postów
        $numberOfPosts=$this->numberOfPosts();

        // liczba elementow na stronie
        $page=$this->page();
        $numberOfPages=ceil($numberOfPosts/$page);
        
        // znajdz posty od najnowszego do najstarszego
        $posts=$this->getPosts(($slug-1)*$page,$page);

        return $this->render('main/index.html.twig', [
            'posts'=> $posts,
            'pageName' => 'blog',
            'prevPage' => $prevPage,
            'nextPage' => $nextPage,
            'numberOfPages' => $numberOfPages,
        ]);
    }

    public function getAuthors($id)
    {   
        // znajdz autorow konkretnego posta
        $query=$this->getDoctrine()
        ->getRepository(PostsByAuthors::class)->createQueryBuilder('p')
        ->leftJoin(Authors::class, 'a', "WITH", "p.idAuthor=a.id")
        ->select('p.idAuthor', 'p.idPost', 'a.id','a.name')
        ->andWhere('p.idPost = (:ids)')
        ->setParameter('ids', $id)
        ->getQuery();
        $authors = $query->execute();
        return $authors;
    }

    /**
     * @Route("/posts/{slug}", name="posts")
     */
    public function showPost($slug)
    {
        // znajdz post o danym id
        $post = $this->getDoctrine()
            ->getRepository(Posts::class)
            ->find($slug);

        // inkrementuj odwiedziny
        $hits=$post->getHits();
        $hits=$hits+1;

        // zapisz odwiedziny do bazy danego posta
        $entityManager = $this->getDoctrine()
            ->getManager();
        $post->setHits($hits);
        $entityManager->flush();

        //pobierz info o poscie i ustaw zmienne
        $topic=$post->getTopic();
        $date=$post->getDate();        
        $pageName = 'blog / #'.$slug;
        $path = 'posts/post'.$slug.'.html.twig';

         // znajdz autorow posta
        $authors=$this->getAuthors($slug);
        
        return $this->render('posts/post-base.html.twig', [
               'path' => $path,
               'pageName' => $pageName,
               'hits' => $hits,
               'topic' => $topic,
               'date' => $date,
               'authors' => $authors, 
               'idPost' => $slug,
           ]);
    }

     /**
     * @Route("/random", name="random")
     */
    public function randomPost()
    {
        $max=$this->numberOfPosts();
        $number = rand(1, $max);



        // przenoszenie do innej funkcji forward
        // $response = $this->forward('App\Controller\PostsController::showPost', array(
        //     'slug' => $number,
        // ));
        //  return $response;


        // http ://symfony.com/doc/current/controller.html#redirecting
        return $this->redirect('posts/'.$number.'');
    

        // wlasne przeniesienie
        // return $this->showPost($number);
    }


    /**
     * @Route("/about", name="about")
     */
    public function aboutMe()
    {
        return $this->render('posts/about.html.twig', [
            'pageName' => "o mnie",
        ]);
    }
    

   
}