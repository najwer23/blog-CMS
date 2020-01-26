<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Quotes;
use App\Entity\AuthorsQuotes;

class QuotesController extends AbstractController
{
    /**
     * @Route("/quotes", name="quotes")
     */
    public function index()
    {
         // znajdz autorow konkretnego posta
        $query = $this->getDoctrine()
            ->getRepository(Quotes::class)->createQueryBuilder('q')
            ->leftJoin(AuthorsQuotes::class, 'aq', "WITH", "q.authorQuote=aq.id")
            ->select('q.quote', 'aq.author')
            ->getQuery();
        $quotes = $query->execute();
        
        return $this->render('quotes/quotes.html.twig', [
             'pageName' => 'cytaty',
            'quotes' => $quotes,
        ]);
    }
}
