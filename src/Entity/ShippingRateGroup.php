<?php

namespace Drupal\commerce_shipping\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;


/**
 * Defines the message entity class.
 *
 * @ContentEntityType(
 *   id = "Shipping",
 *   label = @Translation("Shipping Rate Group"),
 *   base_table = "commerce_shipping",
 *   entity_keys = {
 *     "id" = "shipping_rate_group_id",
 *     "label" = "title",
 *     "fieldable" = TRUE,
 *     "langcode" = "langcode",
 *     "uuid" = "uuid"
 *   },
 * )
 */
class ShippingRateGroup extends ContentEntityBase implements ShippingRateGroupInterface {

  /**
   * {@inheritdoc}
   */
  public function getId() {
    return $this->get('id');
  }

  /**
   * {@inheritdoc}
   */
  public function getLabel() {
    return $this->get('label');
  }

  /**
   * {@inheritdoc}
   */
  public function getRates() {
    return $this->get('rates');
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);
    return $fields;

  }
}