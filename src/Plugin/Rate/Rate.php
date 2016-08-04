<?php

namespace Drupal\commerce_shipping\Plugin\Rate;

use Drupal\Core\Plugin\PluginBase;

class Rate extends PluginBase implements RateInterface {
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
  public function getRate() {
    return $this->pluginDefinition['rate'];
  }

}