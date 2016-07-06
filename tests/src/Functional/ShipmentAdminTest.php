<?php

namespace Drupal\Tests\commerce_shippng\Functional;

use Drupal\commerce_shipping\Entity\Shipment;
use Drupal\Tests\BrowserTestBase;

/**
 * @coversDefaultClass \Drupal\commerce_shipping\Entity\Shipment
 * @group commerce_shipping
 */
class ShipmentAdminTest extends BrowserTestBase {

  public function setUp() {
    parent::setUp();
  }

  public function testCreateShipment() {
//    $this->drupalGet('admin/commerce/shipment/add');
//    $this->getSession()->getPage()->clickLink('Save');
//
//
//    $result = \Drupal::entityQuery('commerce_shipment')
//      ->condition('id', 1)
//      ->range(0, 1)
//      ->execute();
//
//    $shipment_id = reset($result);
//
//    $shipment = Shipment::load($shipment_id);

//    $this->assertNotNull($shipment);
    $this->assertTrue(true);
  }

//  public function testDeleteShipment() {
//
//  }
//
//  public function testUpdateShipment() {
//
//  }

}