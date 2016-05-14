<?php

namespace Drupal\commerce_shipping\Plugin;

use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;

/**
 * Provides the Packing slip base plugin plugin manager.
 */
class PackingSlipBasePluginManager extends DefaultPluginManager {


  /**
   * Constructor for PackingSlipBasePluginManager objects.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct('Plugin/PackingSlipBasePlugin', $namespaces, $module_handler, 'Drupal\commerce_shipping\Plugin\PackingSlipBasePluginInterface', 'Drupal\commerce_shipping\Annotation\PackingSlipBasePlugin');

    $this->alterInfo('commerce_shipping_packing_slip_base_plugin_info');
    $this->setCacheBackend($cache_backend, 'commerce_shipping_packing_slip_base_plugin_plugins');
  }

}
