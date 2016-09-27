<?php

namespace Drupal\commerce_shipping\Entity;

use Drupal\commerce_price\Price;
use Drupal\commerce_shipping\Plugin\Rate\Rate;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;


/**
 * Defines the message entity class.
 *
 * @ContentEntityType(
 *   id = "Shipping",
 *   label = @Translation("Shipping Rate"),
 *   base_table = "commerce_shipping",
 *   entity_keys = {
 *     "id" = "shipping_rate_id",
 *     "label" = "title",
 *     "fieldable" = TRUE,
 *     "langcode" = "langcode",
 *     "uuid" = "uuid"
 *   },
 * )
 */
class ShippingRate extends ContentEntityBase implements ShippingRateInterface {

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
  public function setLabel($label) {
    $this->set('label', $label);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getRate() {
    return $this->get('rate');
  }

  /**
   * {@inheritdoc}
   */
  public function setRate($rate) {
    $this->set('rate', $rate);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);
    return $fields;
  }
}