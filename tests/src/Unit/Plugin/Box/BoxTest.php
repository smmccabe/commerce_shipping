<?php

namespace Drupal\Tests\commerce_shipping\Unit;

use Drupal\commerce_shipping\Plugin\Box;
use Drupal\Tests\UnitTestCase;

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
}