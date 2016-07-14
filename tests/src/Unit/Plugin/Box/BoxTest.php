<?php

namespace Drupal\Tests\commerce_shipping\Unit;

use Drupal\commerce_shipping\Plugin\Box\Box;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\commerce_shipping\Plugin\Box\Box
 * @group commerce_shipping
 */
class BoxTest extends UnitTestCase {

  /**
   * @covers ::getId
   */
  public function testGetId() {
    $plugin_definition = [
      'id' => 'test id',
      'label' => 'test label',
    ];

    $box = new Box([], 'test', $plugin_definition);

    $this->assertEquals('test id', $box->getId());
  }

  /**
   * @covers ::getLabel
   */
  public function testGetLabel() {
    $plugin_definition = [
      'label' => 'test label',
    ];

    $box = new Box([], 'test', $plugin_definition);

    $this->assertEquals('test label', $box->getLabel());
  }

  /**
   * @covers ::getHeight
   */
  public function testGetHeight() {
    $plugin_definition = [
      'label' => 'test label',
      'height' => 1,
    ];

    $box = new Box([], 'test', $plugin_definition);

    $this->assertEquals(1, $box->getHeight());
  }

  /**
   * @covers ::getWidth
   */
  public function testGetWidth() {
    $plugin_definition = [
      'label' => 'test label',
      'width' => 1,
    ];

    $box = new Box([], 'test', $plugin_definition);

    $this->assertEquals(1, $box->getWidth());
  }

  /**
   * @covers ::getDepth
   */
  public function testGetDepth() {
    $plugin_definition = [
      'label' => 'test label',
      'depth' => 1,
    ];

    $box = new Box([], 'test', $plugin_definition);

    $this->assertEquals(1, $box->getDepth());
  }

  /**
   * @covers ::getWeight
   */
  public function testGetWeight() {
    $plugin_definition = [
      'label' => 'test label',
      'weight' => 1,
    ];

    $box = new Box([], 'test', $plugin_definition);

    $this->assertEquals(1, $box->getWeight());
  }

  /**
   * @covers ::getVolume
   */
  public function testGetVolume() {
    $plugin_definition = [
      'label' => 'test label',
      'height' => 2,
      'width' => 3,
      'depth' => 4,
    ];

    $box = new Box([], 'test', $plugin_definition);

    $this->assertEquals(24, $box->getVolume());
  }

}