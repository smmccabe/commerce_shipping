<?php

namespace Drupal\commerce_shipping\Plugin;

use Drupal\Component\Plugin\PluginManagerInterface;

interface BoxGroupManagerInterface extends PluginManagerInterface {

    /**
     *
     */
    public function getBoxByOrder($order_id);
}