<?php

namespace Drupal\commerce_shipping;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Shipment entities.
 *
 * @ingroup commerce_shipping
 */
interface ShipmentInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Shipment name.
   *
   * @return string
   *   Name of the Shipment.
   */
  public function getName();

  /**
   * Sets the Shipment name.
   *
   * @param string $name
   *   The Shipment name.
   *
   * @return \Drupal\commerce_shipping\ShipmentInterface
   *   The called Shipment entity.
   */
  public function setName($name);

  /**
   * Gets the Shipment creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Shipment.
   */
  public function getCreatedTime();

  /**
   * Sets the Shipment creation timestamp.
   *
   * @param int $timestamp
   *   The Shipment creation timestamp.
   *
   * @return \Drupal\commerce_shipping\ShipmentInterface
   *   The called Shipment entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Shipment published status indicator.
   *
   * Unpublished Shipment are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Shipment is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Shipment.
   *
   * @param bool $published
   *   TRUE to set this Shipment to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\commerce_shipping\ShipmentInterface
   *   The called Shipment entity.
   */
  public function setPublished($published);

}
