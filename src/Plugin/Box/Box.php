<?php

namespace Drupal\commerce_shipping\Plugin\Box;

use Drupal\Core\Plugin\PluginBase;

class Box extends PluginBase implements BoxInterface {

  /**
   * The Box Height
   *
   * @var float
   */
  protected $height;

  /**
   * The box width
   *
   * @var float
   */
  protected $width;

  /**
   * The Box Depth
   *
   * @var float
   */
  protected $depth;

  /**
   * The Box Weight
   *
   * @var float
   */
  protected $weight;

  /**
   * {@inheritdoc}
   */
  public function getId() {
    return $this->pluginDefinition['id'];
  }

  /**
   * {@inheritdoc}
   */
  public function getLabel() {
    return $this->pluginDefinition['label'];
  }

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