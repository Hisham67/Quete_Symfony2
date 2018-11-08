<?php
/**
 * Created by PhpStorm.
 * User: hisha
 * Date: 07/11/18
 * Time: 14:44
 */
// src/Controller/LuckyController.php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LuckyController extends AbstractController
{
     /**
      * @Route("/lucky/number")
      */
    public function number()
    {
        $number = random_int(0, 100);

        /*return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );*/
        return $this->render('lucky/number.html.twig', [
            'number' => $number,
        ]);

    }
}


