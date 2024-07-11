<?php

/**
 * CircleService.php
 *
 * @author    Pavan Kumar
 * @since     2024-07-09
 * @package   horus_music
 *
 * @namespace App\Service
 */

# Namespace
namespace App\Service;

# Circle entity
use App\Entity\CircleEntity;

/**
 * Interface CircleServiceInterface
 */
interface CircleServiceInterface
{
  /**
   * Calculate surface area of a circle.
   *
   * @param   CircleEntity $circle
   *
   * @return  float
   * @throws  \Exception
   */
  public function calculateSurface(CircleEntity $circle): float;

  /**
   * Calculate diameter of a circle.
   *
   * @param   CircleEntity $circle
   *
   * @return  float
   * @throws  \Exception
   */
  public function calculateDiameter(CircleEntity $circle): float;
}

# *******************************************************************************************************************
# *******************************************************************************************************************

/**
 * Class CircleService
 */
class CircleService implements CircleServiceInterface
{
  /**
   * Calculate surface area of a circle.
   * info: surface = area of the circle
   *
   * FORMULA:
   * A = π r²
   *
   * @param   CircleEntity $circle
   *
   * @return  float
   * @throws  \Exception
   */
  public function calculateSurface(CircleEntity $circle): float
  {
    try {

      # get radius
      $radius = $circle->getRadius();

      # check if radius is null
      if (is_null($radius)) throw new \Exception("Radius is not set.");

      # area of a circle
      $area = pi() * $radius * $radius;

    } catch (\Exception $e) {
      /** re-throw exception */
      throw $e;
    }

    # return
    return $area;
  }

  # *******************************************************************************************************************
  # *******************************************************************************************************************

  /**
   * Calculate diameter of a circle.
   *
   * FORMULA:
   * D = 2 × r
   *
   * @param   CircleEntity $circle
   *
   * @return  float
   * @throws  \Exception
   */
  public function calculateDiameter(CircleEntity $circle): float
  {
    try {

      # get radius
      $radius = $circle->getRadius();

      # check if radius is null
      if (is_null($radius)) throw new \Exception("Radius is not set.");

      # diameter of a circle
      $d = 2 * $radius;

    } catch (\Exception $e) {
      /** re-throw exception */
      throw $e;
    }

    # return
    return $d;
  }

}