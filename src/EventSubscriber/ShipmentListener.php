<?php

namespace Drupal\commerce_shipping\EventSubscriber;

use Drupal\commerce_order\Adjustment;
use Drupal\commerce_order\Event\OrderEvent;
use Drupal\commerce_order\Event\OrderEvents;
use Drupal\commerce_price\Price;
use Drupal\commerce_shipping\Entity\Shipment;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ShipmentListener implements EventSubscriberInterface {

  public function onOrderUpdate(OrderEvent $event) {
    /** @var \Drupal\commerce_order\Entity\Order $order */
    $order = $event->getOrder();
    /** @var \Drupal\commerce_shipping\Entity\Shipment $shipment */
    if (empty($order->shipment->entity)) {
      $shipment = Shipment::create();
      $order_id = $order->id();
      $shipment->setOrderId($order_id);
      $order->shipment = $shipment;
      $order->save();
    }
  }

  public function onOrderPreSave(OrderEvent $event) {
    /** @var \Drupal\commerce_order\Entity\Order $order */
    $order = $event->getOrder();
    if (!$order->get('total_price')->isEmpty()) {
      // Only run if the total price is not empty.
      foreach ($order->getAdjustments() as $adjustment) {
        if ($adjustment->getType() == 'shipment') {
          $order->removeAdjustment($adjustment);
        }
      }

      /** @var \Drupal\commerce_shipping\Entity\Shipment $shipment */
      $shipment = $order->shipment->entity;
      $rate = $shipment->getShippingRate();
      $method = $shipment->getShippingRateMethod();
      if (!empty($rate) && !empty($method)) {
        $order->addAdjustment(new Adjustment([
          'type' => 'shipment',
          'label' => $method,
          'amount' => $rate,
        ]));
      }
    }
  }

  /**
   * @inheritDoc
   */
  public
  static function getSubscribedEvents() {
    return [
      OrderEvents::ORDER_UPDATE => 'onOrderUpdate',
      OrderEvents::ORDER_PRESAVE => 'onOrderPreSave',
    ];
  }

}