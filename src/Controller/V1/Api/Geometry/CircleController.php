<?php

/**
 * CircleController.php (CIRCLE)
 *
 * @since     2024-07-10
 * @package   horus_music
 *
 * @namespace App\Controller\V1\Api\Geometry
 */

# namespace
namespace App\Controller\V1\Api\Geometry;

# use
use Symfony\Component\HttpFoundation\JsonResponse;

# abstract api controller
use App\Controller\V1\Api\AbstractApiController;

# entity
use App\Entity\CircleEntity;

# service
use App\Service\CircleService;

/**
 * Circle Controller
 */
class CircleController extends AbstractApiController
{
  /**
   * Circle Service
   *
   * @var CircleService
   */
  protected $circleService;

  /**
   * constructor
   *
   * @param CircleService $circleService
   */
  public function __construct(CircleService $circleService)
  {
    # create clients
    $this->circleService = $circleService;
  }

# *******************************************************************************************************************
# *******************************************************************************************************************

  /**
   * method: handleGET
   * The api to calculate surface & diameter of the circle
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
      $this->logger->error('Error calculating circle properties', ['exception' => $e]);
      # error response (to calling client)
      return $this->errorResponse('Error calculating circle properties');
    }

    # response
    return $this->successResponse($result);
  }

# *******************************************************************************************************************
# *******************************************************************************************************************

}
