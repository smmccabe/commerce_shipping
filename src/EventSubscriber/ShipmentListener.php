<?php

namespace Drupal\commerce_shipping\EventSubscriber;

use Drupal\commerce_order\Entity\Order;
use Drupal\commerce_order\Event\OrderEvent;
use Drupal\commerce_order\Event\OrderEvents;
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

  /**
   * @inheritDoc
   */
  public static function getSubscribedEvents() {
    return [
      OrderEvents::ORDER_UPDATE => 'onOrderUpdate',
    ];
  }

}