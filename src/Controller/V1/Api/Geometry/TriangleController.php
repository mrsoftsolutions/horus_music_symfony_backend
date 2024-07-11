<?php

/**
 * TriangleController.php (TRIANGLE)
 *
 * @author    Pavan Kumar
 * @since     2024-07-10
 * @package   horus_music
 *
 * @namespace App\Controller\V1\Api\Geometry
 */

# namespace
namespace App\Controller\V1\Api\Geometry;

# use
use Symfony\Component\HttpFoundation\JsonResponse;
use Psr\Log\LoggerInterface;

# abstract api controller
use App\Controller\V1\Api\AbstractApiController;

# triangle entity & service
use App\Entity\TriangleEntity;
use App\Service\TriangleService;

/**
 * Triangle Controller
 */
class TriangleController extends AbstractApiController
{
  /**
   * Logger
   *
   * @var   LoggerInterface
   */
  protected $logger;

  /**
   * Triangle Service
   *
   * @var TriangleService
   */
  protected $triangleService;

  /**
   * constructor
   *
   * @param LoggerInterface $logger
   * @param TriangleService $triangleService
   */
  public function __construct(LoggerInterface $logger, TriangleService $triangleService)
  {
    # create clients
    $this->logger           = $logger;
    $this->triangleService  = $triangleService;
  }

# *******************************************************************************************************************
# *******************************************************************************************************************

  /**
   * method: handleGET
   * The api is used to calculate surface & diameter of the triangle
   *
   * @param   int           $a
   * @param   int           $b
   * @param   int           $c
   *
   * @return  JsonResponse  The triangle properties
   */
  public function handleGET(int $a, int $b, int $c): JsonResponse
  {
    try {

      # create the triangle entity
      $entity = new TriangleEntity(['a' => $a, 'b' => $b, 'c' => $c]);

      # calculate the surface area of a triangle
      $surface = $this->triangleService->calculateSurface($entity);

      # calculate the diameter of a triangle
      $diameter = $this->triangleService->calculateDiameter($entity);

      # build final result
      $result = [
        'type'      => 'triangle',
        'a'         => $a,
        'b'         => $b,
        'c'         => $c,
        'surface'   => $surface,
        'diameter'  => $diameter
      ];

    } catch (\Exception $e) {
      # log the error
      $this->logger->error($e->getMessage() ?? 'Error calculating triangle properties', ['exception' => $e]);
      # error response (to calling client)
      return $this->errorResponse($e->getMessage() ?? 'Error calculating triangle properties');
    }

    # response
    return $this->successResponse($result);
  }

# *******************************************************************************************************************
# *******************************************************************************************************************

}
