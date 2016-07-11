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
    return $this->pluginDefinition['width'];
  }

  /**
   * {@inheritdoc}
   */
  public function getDepth() {
    return $this->pluginDefinition['depth'];
  }

  /**
   * {@inheritdoc}
   */
  public function getWeight() {
    return $this->pluginDefinition['weight'];
  }

  /**
   * {@inheritdoc}
   */
  public function getVolume() {
    $volume = $this->getHeight() * $this->getWidth() * $this->getDepth();

    return $volume;
  }
}