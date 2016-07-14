<?php

namespace Drupal\Tests\commerce_shipping\Unit;

use Drupal\commerce_shipping\Plugin\Label\Label;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\commerce_shipping\Plugin\Label\Label
 * @group commerce_shipping
 */
class LabelTest extends UnitTestCase {

  /**
   * @covers ::getId
   */
  public function testGetId() {
    $plugin_definition = [
      'id' => 'test id',
      'label' => 'test label',
    ];

    $label = new Label([], 'test', $plugin_definition);

    $this->assertEquals('test id', $label->getId());
  }

  /**
   * @covers ::getLabel
   */
  public function testGetLabel() {
    $plugin_definition = [
      'label' => 'test label',
    ];

    $label = new Label([], 'test', $plugin_definition);

    $this->assertEquals('test label', $label->getLabel());
  }

}