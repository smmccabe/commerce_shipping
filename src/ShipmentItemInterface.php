<?php

namespace Drupal\commerce_shipping;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Shipment item entities.
 *
 * @ingroup commerce_shipping
 */
interface ShipmentItemInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Shipment item name.
   *
   * @return string
   *   Name of the Shipment item.
   */
  public function getName();

  /**
   * Sets the Shipment item name.
   *
   * @param string $name
   *   The Shipment item name.
   *
   * @return \Drupal\commerce_shipping\ShipmentItemInterface
   *   The called Shipment item entity.
   */
  public function setName($name);

  /**
   * Gets the Shipment item creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Shipment item.
   */
  public function getCreatedTime();

  /**
   * Sets the Shipment item creation timestamp.
   *
   * @param int $timestamp
   *   The Shipment item creation timestamp.
   *
   * @return \Drupal\commerce_shipping\ShipmentItemInterface
   *   The called Shipment item entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Shipment item published status indicator.
   *
   * Unpublished Shipment item are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Shipment item is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Shipment item.
   *
   * @param bool $published
   *   TRUE to set this Shipment item to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\commerce_shipping\ShipmentItemInterface
   *   The called Shipment item entity.
   */
  public function setPublished($published);

  /**
   * Gets the shipment id for the shipment that the item is associated with.
   *
   * @return string
   *   The shipment_id that the shipment item is associated with.
   */
  public function getShipmentId();

  /**
   * Sets the shipment id of the shipment the shipment item is associated with.
   *
   * @param string $shipment_id
   *  The integer id of an existing shipment.
   *
   * @return \Drupal\commerce_shipping\ShipmentItemInterface
   *  The called Shipment item entity.
   */
  public function setShipmentId($shipment_id);

}
