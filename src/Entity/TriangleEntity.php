<?php

/**
 * TriangleEntity.php (TRIANGLE data model)
 *
 * @author    Pavan Kumar
 * @since     2024-07-09
 * @package   horus_music
 *
 * @namespace App\Entity
 */

# Namespace
namespace App\Entity;

/**
 * method: TriangleEntity
 */
class TriangleEntity
{
  /**
   * "A" is the length of one side of the triangle.
   *
   * @var  null|int
   */
  protected null|int $a;

  /**
   * "B" is the length of another side of the triangle.
   *
   * @var  null|int
   */
  protected null|int $b;

  /**
   * "C" is the length of the third side of the triangle.
   *
   * @var  null|int
   */
  protected null|int $c;

  /**
   * Constructor
   *
   * @param   array   $fields   Array of fields to initialize the entity
   */
  public function __construct(array $fields = [])
  {
    # initialize the entity
    $this->fromArray($fields);
  }

# *******************************************************************************************************************
# *******************************************************************************************************************

  /**
   * Clear properties to default values
   *
   * @return self
   */
  public function clear(): self
  {
    # clear properties to default values
    $this->setA(null);
    $this->setB(null);
    $this->setC(null);

    return $this;
  }

# *******************************************************************************************************************
# *******************************************************************************************************************

  /**
   * Return object as array
   *
   * @param   array $removedKeys Array of key names to remove from result
   * @return  array
   */
  public function asArray(array $removedKeys = []): array
  {
    # build result (array format)
    $result = [
      'a' => $this->getA(),
      'b' => $this->getB(),
      'c' => $this->getC()
    ];

    # way to remove unwanted data from the result
    foreach ($removedKeys as $key) unset($result[$key]);

    # result
    return $result;
  }

# *******************************************************************************************************************
# *******************************************************************************************************************

  /**
   * Set properties from array
   *
   * @param   array $fields Array of fields
   * @return  array
   */
  public function fromArray(array $fields): array
  {
    # set properties
    $this->setA($fields['a'] ?? null);
    $this->setB($fields['b'] ?? null);
    $this->setC($fields['c'] ?? null);

    # return as array
    return $this->asArray();
  }

# *******************************************************************************************************************
# *******************************************************************************************************************

  /**
   * Get "A" is the length of one side of the triangle.
   *
   * @return  null|int
   */
  public function getA()
  {
    return $this->a;
  }

  /**
   * Set "A" is the length of one side of the triangle.
   *
   * @param  null|int  $a  "A" is the length of one side of the triangle.
   *
   * @return  self
   */
  public function setA(?int $a)
  {
    $this->a = $a;

    return $this;
  }

  /**
   * Get "B" is the length of another side of the triangle.
   *
   * @return  null|int
   */
  public function getB()
  {
    return $this->b;
  }

  /**
   * Set "B" is the length of another side of the triangle.
   *
   * @param  null|int  $b  "B" is the length of another side of the triangle.
   *
   * @return  self
   */
  public function setB(?int $b)
  {
    $this->b = $b;

    return $this;
  }

  /**
   * Get "C" is the length of the third side of the triangle.
   *
   * @return  null|int
   */
  public function getC()
  {
    return $this->c;
  }

  /**
   * Set "C" is the length of the third side of the triangle.
   *
   * @param  null|int  $c  "C" is the length of the third side of the triangle.
   *
   * @return  self
   */
  public function setC(?int $c)
  {
    $this->c = $c;

    return $this;
  }
}