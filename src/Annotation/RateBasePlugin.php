<?php

namespace Drupal\commerce_shipping\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Rate base plugin item annotation object.
 *
 * @see \Drupal\commerce_shipping\Plugin\RateBasePluginManager
 * @see plugin_api
 *
 * @Annotation
 */
class RateBasePlugin extends Plugin {


  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The label of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

}
