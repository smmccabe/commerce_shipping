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

  /**
   * Gets the parent order.
   *
   * @return \Drupal\commerce_order\Entity\OrderInterface|null
   *   The order entity, or null.
   */
  public function getOrder();

  /**
   * Gets the parent order ID.
   *
   * @return int|null
   *   The order id, or null.
   */
  public function getOrderId();

  /**
   * Sets the Shipment Order.
   *
   * @param $order_id
   *   The Order's ID
   *
   * @return \Drupal\commerce_shipping\ShipmentInterface The called Shipment entity.
   * The called Shipment entity.
   */
  public function setOrderId($order_id);

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
   * adds a shipment item based on a line item
   *
   * @param \Drupal\commerce_order\Entity\LineItemInterface $line_item
   *
   * @param int $quantity
   *
   * @return \Drupal\commerce_shipping\ShipmentInterface
   *   The called Shipment entity.
   */
  public function addShipmentItem($line_item, $quantity);

}
