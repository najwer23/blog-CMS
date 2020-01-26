<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Entity\Posts;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function index()
    {
        return $this->render('search/search.html.twig', [
            'pageName' => 'szukaj',
            'g'=> NULL,
        ]);
    }

    /**
    * @Route("/ajaxTitlePost", name="ajaxTitlePost")
    */
    public function ajaxTitlePost(Request $request)
    {
      // znajdz wszystkie tytuly postow
      $query=$this->getDoctrine()
        ->getRepository(Posts::class)->createQueryBuilder('p')
        ->select('p.topic')
        ->getQuery();
        $topic = $query->execute();

      // komunikat
      $msg= array
            (
               array('topic' => $topic),
            );
      return new JsonResponse(array('a'=> $msg));
    }

      /**
     * @Route("/search-results", name="search-results")
     */
    public function search(Request $request)
    {
        $data1=$_GET["search"];
        $search="rezultat";
        $posts=NULL;

        if (strlen($data1) >= 1) {
            // /znajdz posty od najnowszego do najstarszego
            $query=$this->getDoctrine()
            ->getRepository(Posts::class)->createQueryBuilder('p')
            ->select('p.id', 'p.topic')
            ->where('p.topic LIKE :title')
            ->setParameter('title', '%'.$data1.'%')
            ->getQuery();
            $posts = $query->execute();
            $g="Y";
            
            if((boolean)$posts == 0)
            {
                $g = "F";
            }
        }
        else
        {
            $g="F";
        }

        return $this->render('search/search.html.twig', [
            'pageName' => $search,
            'posts'=> $posts,
            'g'=> $g,
        ]);
    }

}
