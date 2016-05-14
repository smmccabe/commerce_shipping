<?php

/**
 * @file
 * Contains shipment.page.inc.
 *
 * Page callback for Shipment entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Shipment templates.
 *
 * Default template: shipment.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_shipment(array &$variables) {
  // Fetch Shipment Entity Object.
  $shipment = $variables['elements']['#shipment'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
