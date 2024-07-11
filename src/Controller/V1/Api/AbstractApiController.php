<?php

/**
 * AbstractApiController.php
 *
 * @author    Pavan Kumar
 * @since     2024-07-08
 * @package   horus_music
 *
 * @namespace App\Controller\V1\Api
 */

# namespace
namespace App\Controller\V1\Api;

# use
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Abstract Controller
 */
abstract class AbstractApiController extends AbstractController
{
  /**
   * successResponse
   *
   * @param   array $data
   *
   * @return  JsonResponse
   */
  public function successResponse(array $data): JsonResponse
  {
    # --- any specific format goes here ---
    # --- request time calculation goes here ---
    # --- response encryption logic goes here ---

    # return
    return new JsonResponse($data);
  }

# *******************************************************************************************************************
# *******************************************************************************************************************

  /**
   * errorResponse
   *
   * @param   string  $message
   * @param   int     $statusCode
   *
   * @return  JsonResponse
   */
  public function errorResponse(string $message, int $statusCode = 500): JsonResponse
  {
    # --- alerts/alarms logic goes here ---
    # --- additional logging goes here ---
    # --- any specific format goes here ---
    # --- request time calculation goes here ---
    # --- response encryption logic goes here ---

    # return
    return new JsonResponse(['error' => $message], $statusCode);
  }

# *******************************************************************************************************************
# *******************************************************************************************************************

}
