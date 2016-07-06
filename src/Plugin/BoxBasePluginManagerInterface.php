<?php

namespace Drupal\commerce_shipping\Plugin;

use Drupal\Component\Plugin\PluginManagerInterface;

/**
 * Defines an interface for box_base_plugin managers.
 */
interface BoxBasePluginManagerInterface extends PluginManagerInterface {
  // Add getters and other public methods for box_base_plugin managers.

  /**
   * Get's the width of this box.
   *
   * @return float
   */
  public function getHeight();

  /**
   * Get's the width of this box.
   *
   * @return float
   */
  public function getWeight();

  /**
   * Get's the width of this box.
   *
   * @return float
   */
  public function getWidth();

  /**
   * Get's the width of this box.
   *
   * @return float
   */
  public function getDepth();
}