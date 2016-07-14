<?php

namespace Drupal\Tests\commerce_shipping\Unit;

use Drupal\commerce_shipping\Plugin\Rate\Rate;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\commerce_shipping\Plugin\Rate\Rate
 * @group commerce_shipping
 */
class RateTest extends UnitTestCase {

  /**
   * @covers ::getId
   */
  public function testGetId() {
    $plugin_definition = [
      'id' => 'test id',
      'label' => 'test label',
    ];

    $rate = new Rate([], 'test', $plugin_definition);

    $this->assertEquals('test id', $rate->getId());
  }

  /**
   * @covers ::getLabel
   */
  public function testGetLabel() {
    $plugin_definition = [
      'label' => 'test label',
    ];

    $rate = new Rate([], 'test', $plugin_definition);

    $this->assertEquals('test label', $rate->getLabel());
  }

  /**
   * @covers ::getRate
   */
  public function testGetRate() {
    $plugin_definition = [
      'label' => 'test label',
      'height' => 1,
    ];

    $rate = new Rate([], 'test', $plugin_definition);

    $this->assertEquals(1, $rate->getRate());
  }

}