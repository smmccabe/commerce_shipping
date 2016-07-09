<?php

namespace Drupal\commerce_shipping\Plugin;

use Drupal\Component\Plugin\Exception\PluginException;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Plugin\Discovery\ContainerDerivativeDiscoveryDecorator;
use Drupal\Core\Plugin\Discovery\YamlDiscovery;

/**
 * Provides the default box_base_plugin manager.
 */
class BoxBasePluginManager extends DefaultPluginManager implements BoxBasePluginManagerInterface {

  /**
   * The Box Height
   *
   * @var float
   */
  public $height;

  /**
   * The Box Weight
   *
   * @var float
   */
  public $weight;

  /**
   * The Box Depth
   *
   * @var float
   */
  public $box;

  /**
   * The box width
   *
   * @var float
   */
  public $width;

  /**
   * Provides default values for all box_base_plugin plugins.
   *
   * @var array
   */
  protected $defaults = array(
    // Add required and optional plugin properties.
    'id' => '',
    'label' => '',
    'height' => 0.00,
    'width' => 0.00,
    'depth' => 0.00,
    'weight' => 0.00,
    'class' => '\Drupal\commerce_shipping\Plugin\Box'
  );

  /**
   * Constructs a BoxBasePluginManager object.
   *
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   */
  public function __construct(ModuleHandlerInterface $module_handler, CacheBackendInterface $cache_backend) {
    // Add more services as required.
    $this->moduleHandler = $module_handler;
    $this->setCacheBackend($cache_backend, 'box_base_plugin', array('box_base_plugin'));
  }

  /**
   * {@inheritdoc}
   */
  protected function getDiscovery() {
    if (!isset($this->discovery)) {
      $this->discovery = new YamlDiscovery('box.base.plugin', $this->moduleHandler->getModuleDirectories());
      $this->discovery->addTranslatableProperty('label', 'label_context');
      $this->discovery = new ContainerDerivativeDiscoveryDecorator($this->discovery);
    }
    return $this->discovery;
  }

  /**
   * {@inheritdoc}
   */
  public function processDefinition(&$definition, $plugin_id) {
    parent::processDefinition($definition, $plugin_id);

    // You can add validation of the plugin definition here.
    if (empty($definition['id'])) {
      throw new PluginException(sprintf('Example plugin property (%s) definition "is" is required.', $plugin_id));
    }
  }

  // Add other methods here as defined in the BoxBasePluginManagerInterface.

  /**
   * Get's the height of this box.
   *
   * @return float
   */
  public function getHeight() {
    return $this->height;
  }

  /**
   * Get's the weight of this box.
   *
   * @return float
   */
  public function getWeight() {
    return $this->height;
  }

  /**
   * Get's the width of this box.
   *
   * @return float
   */
  public function getWidth() {
    return $this->height;
  }

  /**
   * Get's the depth of this box.
   *
   * @return float
   */
  public function getDepth() {
    return $this->height;
  }
}