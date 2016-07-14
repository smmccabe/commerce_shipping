<?php


namespace Drupal\commerce_shipping\Plugin\PackingSlip;

use Drupal\Core\Plugin\PluginBase;

class PackingSlip extends PluginBase implements PackingSlipInterface{

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
  public function getDescription() {
    return $this->pluginDefinition['description'];
  }

}