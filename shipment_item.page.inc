<?php

/**
 * @file
 * Contains shipment_item.page.inc.
 *
 * Page callback for Shipment item entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Shipment item templates.
 *
 * Default template: shipment_item.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_shipment_item(array &$variables) {
  // Fetch ShipmentItem Entity Object.
  $shipment_item = $variables['elements']['#shipment_item'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
