<?php

/**
 * CircleController.php (CIRCLE)
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

# circle entity & service
use App\Entity\CircleEntity;
use App\Service\CircleService;

/**
 * Circle Controller
 */
class CircleController extends AbstractApiController
{
  /**
   * Logger
   *
   * @var   LoggerInterface
   */
  protected $logger;

  /**
   * Circle Service
   *
   * @var CircleService
   */
  protected $circleService;

  /**
   * constructor
   *
   * @param LoggerInterface $logger
   * @param CircleService   $circleService
   */
  public function __construct(LoggerInterface $logger, CircleService $circleService)
  {
    # create clients
    $this->logger           = $logger;
    $this->circleService    = $circleService;
  }

# *******************************************************************************************************************
# *******************************************************************************************************************

  /**
   * method: handleGET
   * The api is used to calculate surface & diameter of the circle
   *
   * @param   float         $radius
   *
   * @return  JsonResponse  The circle properties
   */
  public function handleGET(float $radius): JsonResponse
  {
    try {

      # create the circle entity
      $entity = new CircleEntity(['radius'=> $radius]);

      # calculate the surface area of a circle
      $surface = $this->circleService->calculateSurface($entity);

      # calculate the diameter of a circle
      $diameter = $this->circleService->calculateDiameter($entity);

      # build final result
      $result = [
        'type'      => 'circle',
        'radius'    => $radius,
        'surface'   => $surface,
        'diameter'  => $diameter
      ];

    } catch (\Exception $e) {
      # log the error
      $this->logger->error($e->getMessage() ?? 'Error calculating circle properties', ['exception' => $e]);
      # error response (to calling client)
      return $this->errorResponse($e->getMessage() ?? 'Error calculating circle properties');
    }

    # response
    return $this->successResponse($result);
  }

}
