<?php

namespace Drupal\commerce_shipping\Plugin\Label;


interface LabelInterfance {

  /**
   * Get box id
   *
   * @return string
   */
  public function getId();

  /**
   * Get box label
   *
   * @return string
   */
  public function getLabel();

}