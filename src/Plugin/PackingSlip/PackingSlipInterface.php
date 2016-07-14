<?php

namespace Drupal\commerce_shipping\Plugin\PackingSlip;

interface PackingSlipInterface {

  /**
   * Get packing slip id
   *
   * @return string
   */
  public function getId();

  /**
   * Get packing slip label
   *
   * @return string
   */
  public function getLabel();

  /**
   * Get packing slip description
   *
   * @return string
   */
  public function getDescription();

}