<?php

namespace Drupal\commerce_shipping\Plugin\Box;

Drupal\Core\Plugin\PluginBase;

class Box extends PluginBase implements BoxInterface {

  /**
   * The Box Height
   *
   * @var float
   */
  public $height;

  /**
   * The box width
   *
   * @var float
   */
  public $width;

  /**
   * The Box Depth
   *
   * @var float
   */
  public $depth;

  /**
   * The Box Weight
   *
   * @var float
   */
  public $weight;

  /**
   * Get the height of this box.
   *
   * @return float
   */
  public function getHeight() {
    return $this->height;
  }

  /**
   * Get the width of this box.
   *
   * @return float
   */
  public function getWidth() {
    return $this->width;
  }

  /**
   * Get the depth of this box.
   *
   * @return float
   */
  public function getDepth() {
    return $this->depth;
  }

  /**
   * Get the weight of this box.
   *
   * @return float
   */
  public function getWeight() {
    return $this->weight;
  }
}