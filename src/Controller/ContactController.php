<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index()
    {
        return $this->render('contact/contact.html.twig', [
            'pageName' => 'kontakt',
        ]);
    }

    /**
     * @Route("/contact/ajaxMail", name="ajaxMail")
     */
    public function sendMail(Request $request, \Swift_Mailer $mailer)
    {      
        // pobierz
        $data1 = $request->get('email');
        $data2 = $request->get('name');
        $data3 = $request->get('surname');
        $data4 = $request->get('topic');
        $data5 = $request->get('text');

        // walidacja poprawnosci maila "."
        if (filter_var($data1, FILTER_VALIDATE_EMAIL)) {

            $flag = 1;
            //to wyslij email
            // $email = Array($data1=>$data2);
            $message = (new \Swift_Message($data4))
            // ->setFrom($data1, $data2)
                ->setFrom([$data1 => $data2 . ' ' . $data3])
                ->setCc([$data1 => $data2 . ' ' . $data3])
                ->setTo('garnela32@gmail.com')
                ->setBody($data5);
            $mailer->send($message);   
        }
        else{

            $flag = 0;
        }

        //pokaz komunikat
        $msg = array(
            array('email' => $flag),
        );
        
        return new JsonResponse(array('a' => $msg));
    }
}
