<?php

namespace Drupal\commerce_shipping\Form;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\inline_entity_form\Form\EntityInlineForm;


/**
 * Defines the inline form for shipment items.
 */
class ShipmentItemInlineForm extends EntityInlineForm {

  /**
   * {@inheritdoc}
   */
  public function getEntityTypeLabels() {
    $labels = [
      'singular' => t('shipment item'),
      'plural' => t('shipment items')
    ];

    return $labels;
  }

}
