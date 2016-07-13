<?php

namespace Drupal\commerce_shipping;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Shipment item entity.
 *
 * @see \Drupal\commerce_shipping\Entity\ShipmentItem.
 */
class ShipmentItemAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\commerce_shipping\ShipmentItemInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished shipment item entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published shipment item entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit shipment item entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete shipment item entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add shipment item entities');
  }

}
