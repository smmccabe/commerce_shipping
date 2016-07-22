<?php

namespace Drupal\Tests\commerce_shipping\Functional;

use Drupal\commerce_shipping\Entity\Shipment;
use Drupal\commerce_shipping\Entity\ShipmentItem;
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
      'view shipment entities',
      'administer shipment item entities',
      'add shipment item entities',
      'delete shipment item entities',
      'edit shipment item entities',
      'view published shipment item entities',
      'view unpublished shipment item entities',
    ], parent::getAdministratorPermissions());
  }

  /**
   * Test that we're successfully able to create a shipment through the administrator backend.
   */
  public function testCreateShipment() {

    $this->drupalGet('admin/commerce/shipment/add');
    $this->assertSession()->statusCodeEquals(200);
    $this->submitForm(array(), 'Add new shipment item');

    $shipment_name = $this->randomMachineName();
    $item_name = $this->randomMachineName();

    $edit = [
      'name[0][value]' => $shipment_name
    ];
    $item_edit = [
      'field_shipment_items[form][inline_entity_form][name][0][value]' => $item_name
    ];

    $this->submitForm($item_edit, 'Create shipment item');
    $this->submitForm($edit, 'Save');

    $result = \Drupal::entityQuery('commerce_shipment')
      ->condition('name', $shipment_name)
      ->range(0, 1)
      ->execute();

    $shipment_id = reset($result);
    $shipment    = Shipment::load($shipment_id);
    $this->assertNotNull($shipment);

    $result = \Drupal::entityQuery('commerce_shipment_item')
      ->condition('name', $item_name)
      ->range(0, 1)
      ->execute();

    $shipment_item_id = reset($result);
    $shipment_item    = ShipmentItem::load($shipment_item_id);
    $this->assertNotNull($shipment_item);
  }

  /**
   * Test that we're successfully able to delete an existing shipment in the administrator backend.
   */
  public function testDeleteShipment() {
    $shipment = Shipment::create([
      'name' => 'test shipment',
      'id' => 1
    ]);
    $shipment->save();

    $shipment_item = ShipmentItem::create([
      'name' => 'test shipment item',
      'id' => 1,
      'shipment_id' => $shipment->id()
    ]);
    $shipment_item->save();

    $this->drupalGet($shipment->toUrl('delete-form'));
    $this->assertSession()->statusCodeEquals(200);
    $this->submitForm([], 'Delete');

    \Drupal::service('entity_type.manager')->getStorage('commerce_shipment')->resetCache();

    $deleted_shipment = Shipment::load($shipment->id());
    $this->assertNull($deleted_shipment);

    $deleted_shipment_item = ShipmentItem::load($shipment_item->id());
    $this->assertNull($deleted_shipment_item);
  }

  /**
   * @TODO use inline form instead of manually creating shipment
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

    $shipment_item = ShipmentItem::create([
      'name' => 'test shipment item',
      'id' => 1,
      'shipment_id' => $shipment->id()
    ]);
    $shipment_item->save();


    $updated_shipment_item = ShipmentItem::load($shipment_item->id());
    $this->assertEquals($updated_shipment_item->getName(), 'test shipment item');
  }

}
