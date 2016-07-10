<?php

namespace Drupal\commerce_shipping\Plugin\Label;

use Drupal\Core\Plugin\PluginBase;

class Label extends PluginBase implements LabelInterfance{

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
  
}