<?php

namespace Drupal\commerce_shipping\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Shipment item entities.
 */
class ShipmentItemViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['shipment_item']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Shipment item'),
      'help' => $this->t('The Shipment item ID.'),
    );

    return $data;
  }

}
