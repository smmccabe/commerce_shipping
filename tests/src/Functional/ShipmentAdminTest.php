<?php

namespace Drupal\Tests\commerce_shipping\Functional;

use Drupal\commerce_shipping\Entity\Shipment;
use Drupal\Tests\commerce\Functional\CommerceBrowserTestBase;
use Drupal\Tests\BrowserTestBase;

/**
 * @coversDefaultClass \Drupal\commerce_shipping\Entity\Shipment
 * @group commerce_shipping
 */
class ShipmentAdminTest extends CommerceBrowserTestBase {

  /**
   * Enabled modules
   */
  public static $modules = ['commerce_shipping'];

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * {@inheritdoc}
   */
  protected function getAdministratorPermissions() {
    return array_merge([
      'administer shipment entities',
      'add shipment entities',
      'delete shipment entities',
      'edit shipment entities',
      'view shipment entities'
    ], parent::getAdministratorPermissions());
  }

  /**
   * Test that we're successfully able to create a shipment through the administrator backend.
   */
  public function testCreateShipment() {

    $this->drupalGet('admin/commerce/shipment/add');
    $this->assertSession()->statusCodeEquals(200);

    $name = 'testShipment';
    $edit = [
      'name[0][value]' => $name
    ];

    $this->submitForm($edit, 'Save');

    $result = \Drupal::entityQuery('commerce_shipment')
      ->condition('id', 1)
      ->range(0, 1)
      ->execute();

    $shipment_id = reset($result);
    $shipment    = Shipment::load($shipment_id);
    $this->assertNotNull($shipment);
  }

  /**
   * Test that we're successfully able to delete an existing shipment in the administrator backend.
   */
  public function testDeleteShipment() {
    $order = $this->createEntity('commerce_order', [
      'type' => 'default',
      'mail' => $this->loggedInUser->getEmail(),
    ]);

    $shipment = Shipment::create([
      'name' => 'testShipment',
      'id' => 1,
      'order_id' => $order->order_id,
    ]);
    $shipment->save();

    $this->drupalGet($shipment->toUrl('delete-form'));
    $this->assertSession()->statusCodeEquals(200);
    $this->submitForm([], 'Delete');

    \Drupal::service('entity_type.manager')->getStorage('shipment')->resetCache();

    $deleted_shipment = Shipment::load($shipment->id());
    $this->assertNull($deleted_shipment);
  }

  /**
   * Test that we're successfully able to update an existing shipment in the administrator backend.
   */
  public function testUpdateShipment() {
    $order = $this->createEntity('commerce_order', [
      'type' => 'default',
      'mail' => $this->loggedInUser->getEmail(),
    ]);

    $shipment = Shipment::create([
      'name' => 'testShipment',
      'id' => 1,
      'order_id' => $order->order_id,
    ]);
    $shipment->save();

    $name = 'newName';
    $edit = [
      'name[0][value]' => $name
    ];

    $this->drupalGet($shipment->toUrl('edit-form'));
    $this->assertSession()->statusCodeEquals(200);
    $this->submitForm($edit, 'Save');

    $updated_shipment = Shipment::load($shipment->id());
    $this->assertEquals($updated_shipment->getName(), $name);
  }

}
