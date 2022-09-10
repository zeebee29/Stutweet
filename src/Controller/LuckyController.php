<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
  /**
   * @Route("lucky", name="app_lucky_number")
   */
  public function number(): Response
  {
    $number = random_int(0, 100);
    
    return new Response ("<html><h1>Un nombre : $number</h1></html>");
  }
  
  #[Route("random")]
  public function random(): Response
  {
    $number = random_int(0, 100);
    
    return new Response ("<html><h1>Un autre nombre : $number</h1></html>");
  }

  #[Route("lucky-random")]
  public function randomNumber(): Response
  {
    $number = random_int(0, 100);
    
    return $this->render("/lucky/randomNumber.html.twig", ["number" => $number]);

  }

}