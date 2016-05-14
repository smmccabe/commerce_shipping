<?php

namespace Drupal\commerce_shipping;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Shipment entity.
 *
 * @see \Drupal\commerce_shipping\Entity\Shipment.
 */
class ShipmentAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\commerce_shipping\ShipmentInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished shipment entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published shipment entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit shipment entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete shipment entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add shipment entities');
  }

}
