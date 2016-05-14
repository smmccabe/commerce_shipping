<?php

namespace Drupal\commerce_shipping\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Shipment entities.
 */
class ShipmentViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['shipment']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Shipment'),
      'help' => $this->t('The Shipment ID.'),
    );

    return $data;
  }

}
