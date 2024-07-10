<?php

/**
 * TriangleService.php
 *
 * @since     2024-07-09
 * @package   horus_music
 *
 * @namespace App\Service
 */

# Namespace
namespace App\Service;

# Triangle entity
use App\Entity\TriangleEntity;

/**
 * Interface TriangleServiceInterface
 */
interface TriangleServiceInterface
{
  /**
   * Calculate surface area of a triangle.
   *
   * @param   TriangleEntity $triangle
   *
   * @return  float
   * @throws  \Exception
   */
  public function calculateSurface(TriangleEntity $triangle): float;

  /**
   * Calculate diameter of a triangle using circumradius.
   *
   * @param   TriangleEntity $triangle
   *
   * @return  float
   * @throws  \Exception
   */
  public function calculateDiameter(TriangleEntity $triangle): float;
}

# *******************************************************************************************************************
# *******************************************************************************************************************

/**
 * Class TriangleService
 */
class TriangleService implements TriangleServiceInterface
{
  /**
   * Calculate surface area of a triangle.
   *
   * FORMULA:
   * Heron's formula: A = √(s*(s-a)*(s-b)*(s-c))
   * where s = (a + b + c) / 2
   *
   * If we know the base & height, we can use below formula
   * A = 1/2 * b * h
   *
   * @param   TriangleEntity $triangle
   *
   * @return  float
   * @throws  \Exception
   */
  public function calculateSurface(TriangleEntity $triangle): float
  {
    try {

      # get sides
      $a = $triangle->getA();
      $b = $triangle->getB();
      $c = $triangle->getC();

      # check if sides are null
      if (is_null($a) || is_null($b) || is_null($c)) {
        throw new \Exception("One or more sides are not set.");
      }

      # semi-perimeter
      $s = ($a + $b + $c) / 2;

      # area of a triangle using Heron's formula
      $area = sqrt($s * ($s - $a) * ($s - $b) * ($s - $c));

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
   * Calculate diameter of a triangle using circumradius.
   *
   * @param   TriangleEntity  $triangle
   *
   * @return  float           The diameter of the triangle
   * @throws  \Exception
   */
  public function calculateDiameter(TriangleEntity $triangle): float
  {
    try {

      # get all sides of the triangle
      $a = $triangle->getA();
      $b = $triangle->getB();
      $c = $triangle->getC();

      # make sure all sides are not null
      if (\is_null($a) || \is_null($b) || \is_null($c)) throw new \Exception("One or more sides are not set.");

      # calculate the area of the triangle
      $area = $this->calculateSurface($triangle);

      # calculate circumradius
      $circumradius = ($a * $b * $c) / (4 * $area);

      # calculate diameter
      $diameter = 2 * $circumradius;

    } catch (\Exception $e) {
      # re-throw exception
      throw $e;
    }

    # return
    return $diameter;
  }

}
