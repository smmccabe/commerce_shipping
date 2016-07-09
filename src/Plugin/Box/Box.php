<?php

namespace Drupal\commerce_shipping\Plugin\Box;

use Drupal\Core\Plugin\PluginBase;

class Box extends PluginBase implements BoxInterface {

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
   * {@inheritdoc}
   */
  public function getHeight() {
    return $this->pluginDefinition['height'];
  }

  /**
   * {@inheritdoc}
   */
  public function getWidth() {
    return $this->width;
  }

  /**
   * {@inheritdoc}
   */
  public function getDepth() {
    return $this->depth;
  }

  /**
   * {@inheritdoc}
   */
  public function getWeight() {
    return $this->weight;
  }
}