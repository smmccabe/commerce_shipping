<?php

namespace Drupal\commerce_shipping\Entity;

use Drupal\Core\Entity\ContentEntityInterface;

interface ShippingRateInterface extends ContentEntityInterface {
  /**
   * Get rate id
   *
   * @return string
   */
  public function getId();

  /**
   * Get rate label
   *
   * @return string
   */
  public function getLabel();

  /**
   * Get the rate.
   *
   * @return float
   */
  public function getRate();

}