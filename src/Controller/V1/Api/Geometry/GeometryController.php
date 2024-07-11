<?php

/**
 * GeometryController.php
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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Psr\Log\LoggerInterface;

# abstract api controller
use App\Controller\V1\Api\AbstractApiController;

# entity
use App\Entity\CircleEntity;
use App\Entity\TriangleEntity;

# service
use App\Service\CircleService;
use App\Service\TriangleService;

/**
 * Geometry Controller
 */
class GeometryController extends AbstractApiController
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
   * Triangle Service
   *
   * @var TriangleService
   */
  protected $triangleService;

  /**
   * constructor
   *
   * @param LoggerInterface $logger
   * @param CircleService   $circleService
   * @param TriangleService $triangleService
   */
  public function __construct(LoggerInterface $logger, CircleService $circleService, TriangleService $triangleService)
  {
    # create clients
    $this->logger           = $logger;
    $this->circleService    = $circleService;
    $this->triangleService  = $triangleService;
  }

# *******************************************************************************************************************
# *******************************************************************************************************************

  /**
   * method: handlePOST
   * The api to calculate sum of surface & diameter of the circle
   *
   * EXPECTED PAYLOAD:
   * {
   *    "object_1": { // can be a circle or triangle -> let's consider circle
   *      "radius": 5
   *    },
   *    "object_2": { // can be a circle or triangle -> let's consider triangle
   *      "a": 5,
   *      "b": 6,
   *      "c": 7
   *    }
   * }
   *
   * @param   float         $radius
   *
   * @return  JsonResponse  The circle properties
   */
  public function handlePOST(Request $request): JsonResponse
  {
    try {

      # Validate HTTP Request "Content-type"
      if (!preg_match('/application\/json/i', $request->headers->get('Content-Type'))) {
        throw new \Exception('Content-Type must be "application/json"');
      }

      # Decode payload
      $payload = \json_decode($request->getContent(), true) ?? [];
      if (empty($payload)) throw new \Exception('Invalid post body');

      # make sure user sent 2 objects
      if (\count($payload) < 2) throw new \Exception('Mandatory to send 2 objects');

      # make sure object_1 is sent & not empty
      if (!\array_key_exists('object_1', $payload) || empty($payload['object_1'] ?? [])) {
        throw new \Exception('{object_1} is a mandatory');
      }

      # make sure object_2 is sent & not empty
      if (!\array_key_exists('object_2', $payload) || empty($payload['object_2'] ?? [])) {
        throw new \Exception('{object_2} is a mandatory');
      }

      # Initialize the result
      $result = [
        'sum_of_areas'     => 0,
        'sum_of_diameters' => 0
      ];

      # object - 1
      $object1 = $this->calculateSurfaceDiameterOfTheObject($payload['object_1']);

      # object - 2
      $object2 = $this->calculateSurfaceDiameterOfTheObject($payload['object_2']);

      # sum of areas & diameters
      $result['sum_of_areas']     = $object1['area'] + $object2['area'];
      $result['sum_of_diameters'] = $object1['diameter'] + $object2['diameter'];

    } catch (\Exception $e) {
      # log the error
      $this->logger->error($e->getMessage() ?? 'Error calculating sum of circles', ['exception' => $e]);
      # error response (to calling client)
      return $this->errorResponse($e->getMessage() ?? 'Error calculating sum of circles');
    }

    # response
    return $this->successResponse($result);
  }

# *******************************************************************************************************************
# **************************************** INTERNAL PRIVATE METHODS *************************************************
# *******************************************************************************************************************

  /**
   * method: calculateSurfaceDiameterOfTheObject
   * This internal method is used to identify the object & calculate surface & diameter of the object
   *
   * @param   array $object
   *
   * @return  array The circle properties
   * @throws  \Exception
   */
  private function calculateSurfaceDiameterOfTheObject(array $object): array
  {
    try {

      # result
      $result = [
        'area'     => 0,
        'diameter' => 0
      ];

      # identify object
      if (\array_key_exists('radius', $object)) {

        # calculate the surface (area) & diameter of the circle
        $entity = new CircleEntity(['radius'=>$object['radius']]);

        # calculate the surface area of a circle
        $result['area'] = $this->circleService->calculateSurface($entity);

        # calculate the diameter of a circle
        $result['diameter'] = $this->circleService->calculateDiameter($entity);

      } else if (\array_key_exists('a', $object) && \array_key_exists('b', $object) && \array_key_exists('c', $object)) {

        # calculate the surface (area) & diameter of the triangle
        $entity = new TriangleEntity(['a'=>$object['a'], 'b'=>$object['b'], 'c'=>$object['c']]);

        # calculate the surface area of a triangle
        $result['area'] = $this->triangleService->calculateSurface($entity);

        # calculate the diameter of a triangle
        $result['diameter'] = $this->triangleService->calculateDiameter($entity);

      } else {
        # object-1 must be a circle or a triangle
        throw new \Exception('{object} must be a circle or a triangle');
      }

    } catch (\Exception $e) {
      # re-throw exception
      throw $e;
    }

    # return
    return $result;
  }

}
