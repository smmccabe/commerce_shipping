<?php

namespace Drupal\commerce_shipping\Plugin;

use Drupal\Core\Plugin\DefaultPluginManager;

class BoxGroupManager extends DefaultPluginManager implements BoxGroupManagerInterface {

  protected $defaults = [
    'id' => '',
    'label' => '',
    'class' => 'Drupal\commerce_shipping\Plugin\BoxGroup\BoxGroup',
    'box_class' => '\Drupal\commerce_shipping\Plugin\Box\Box',
  ];

  public function getBoxByOrder($order_id) {
    // TODO: Implement getDefinitionsByOrder() method.
  }
}