<?php

# namespace
namespace App\Controller\V1\Api;

# use
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Psr\Log\LoggerInterface;

/**
 * Abstract Controller
 */
abstract class AbstractApiController extends AbstractController
{
  /**
   * Logger
   *
   * @var   LoggerInterface
   */
  protected $logger;

  /**
   * Initialization method
   *
   * This method is called right after the controller has been created before any route specific Middleware handlers
   *
   * @param array  $args   Path variable arguments as name=value pairs
   */
  public function initialize(LoggerInterface $logger)
  {
    # create client
    $this->logger = $logger;

    return ;
  }

# *******************************************************************************************************************
# *******************************************************************************************************************

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
