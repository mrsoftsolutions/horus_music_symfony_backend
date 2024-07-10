<?php

/**
 * CircleEntity.php (CIRCLE data model)
 *
 * @since     2024-07-09
 * @package   horus_music
 *
 * @namespace App\Entity
 */

# Namespace
namespace App\Entity;

/**
 * method: CircleEntity
 */
class CircleEntity
{
  /**
   * Radius of the circle
   *
   * @var  null|float
   */
  protected null|float $radius;

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
    $this->setRadius(null);

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
      'radius' => $this->getRadius()
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
    $this->setRadius($fields['radius'] ?? null);

    # return as array
    return $this->asArray();
  }

# *******************************************************************************************************************
# *******************************************************************************************************************

  /**
   * Get radius of the circle
   *
   * @return  null|float
   */
  public function getRadius()
  {
    return $this->radius;
  }

  /**
   * Set radius of the circle
   *
   * @param  null|float  $radius  Radius of the circle
   *
   * @return  self
   */
  public function setRadius(?float $radius)
  {
    $this->radius = $radius;

    return $this;
  }

}
