<?php

namespace Drupal\commere_shipping\Plugin\Rate;

interface RateInterface {
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