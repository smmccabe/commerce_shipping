<?php

namespace Drupal\Tests\commerce_shipping\Unit;

use Drupal\commerce_shipping\Plugin\PackingSlip\PackingSlip;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\commerce_shipping\Plugin\PackingSlip\PackingSlip
 * @group commerce_shipping
 */
class PackingSlipTest extends UnitTestCase {

  /**
   * @covers ::getId
   */
  public function testGetId() {
    $plugin_definition = [
      'id' => 'test id',
      'label' => 'test label',
    ];

    $packing_slip = new PackingSlip([], 'test', $plugin_definition);

    $this->assertEquals('test id', $packing_slip->getId());
  }

  /**
   * @covers ::getLabel
   */
  public function testGetLabel() {
    $plugin_definition = [
      'label' => 'test label',
    ];

    $packing_slip = new PackingSlip([], 'test', $plugin_definition);

    $this->assertEquals('test label', $packing_slip->getLabel());
  }

  /**
   * @covers ::getDescription
   */
  public function testGetDescription() {
    $plugin_definition = [
      'label' => 'test label',
      'description' => 'packing slip description',
    ];

    $packing_slip = new PackingSlip([], 'test', $plugin_definition);

    $this->assertEquals('packing slip description', $packing_slip->getDescription());
  }
}