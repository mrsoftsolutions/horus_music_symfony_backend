<?php

/**
 * AppController.php
 *
 * @author    Pavan Kumar
 * @since     2024-07-08
 * @package   horus_music
 *
 * @namespace App\Controller
 */

# namespace
namespace App\Controller;

# use
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * App Controller
 */
class AppController extends AbstractController
{
  /**
   * HEALTH API
   *
   * @return  Response
   */
  public function index()
  {
    # return json
    return $this->json(['status'=>'OK'], 200);
  }

# *******************************************************************************************************************
# *******************************************************************************************************************

}