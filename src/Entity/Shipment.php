<?php

namespace Drupal\commerce_shipping\Entity;

use Drupal\commerce_shipping\Plugin\Rate\Rate;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\commerce_shipping\ShipmentInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Shipment entity.
 *
 * @ingroup commerce_shipping
 *
 * @ContentEntityType(
 *   id = "commerce_shipment",
 *   label = @Translation("Shipment"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\commerce_shipping\ShipmentListBuilder",
 *     "views_data" = "Drupal\commerce_shipping\Entity\ShipmentViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\commerce_shipping\Form\ShipmentForm",
 *       "add" = "Drupal\commerce_shipping\Form\ShipmentForm",
 *       "edit" = "Drupal\commerce_shipping\Form\ShipmentForm",
 *       "delete" = "Drupal\commerce_shipping\Form\ShipmentDeleteForm",
 *     },
 *     "access" = "Drupal\commerce_shipping\ShipmentAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\commerce_shipping\ShipmentHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "shipment",
 *   admin_permission = "administer shipment entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/commerce/shipment/{commerce_shipment}",
 *     "add-form" = "/admin/commerce/shipment/add",
 *     "edit-form" = "/admin/commerce/shipment/{commerce_shipment}/edit",
 *     "delete-form" = "/admin/commerce/shipment/{commerce_shipment}/delete",
 *     "collection" = "/admin/commerce/shipment",
 *   },
 *   field_ui_base_route = "commerce_shipment.settings"
 * )
 */
class Shipment extends ContentEntityBase implements ShipmentInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += array(
      'user_id' => \Drupal::currentUser()->id(),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getOrder() {
    return $this->get('order_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOrderId() {
    return $this->get('order_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getShipmentItems() {
    return $this->get('field_shipment_items')->referencedEntities();
  }

  /**
   * {@inheritdoc}
   */
  public function setShipmentItems(array $shipment_items) {
    $this->set('field_shipment_items', $shipment_items);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getShippingRate() {
    return $this->get('shipping_rate')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setShippingRate($rate) {
    $this->set('shipping_rate', $rate);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function postSave(EntityStorageInterface $storage, $update = TRUE) {
    parent::postSave($storage, $update);

    foreach ($this->field_shipment_items as $item) {
      $shipment_item = $item->entity;
      $id = $shipment_item->getShipmentId();

      if (empty($id)) {
        $shipment_item->setShipmentId($this->id());
        $shipment_item->save();
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function postDelete(EntityStorageInterface $storage, array $entities) {
    parent::postDelete($storage, $entities);
    $shipment_items = [];

    foreach ($entities as $entity) {
      if (empty($entity->field_shipment_items)) {
        continue;
      }
      foreach ($entity->field_shipment_items as $item) {
        $shipment_items[$item->target_id] = $item->entity;
      }
    }

    $shipment_item_storage = \Drupal::service('entity_type.manager')
      ->getStorage('commerce_shipment_item');
    $shipment_item_storage->delete($shipment_items);
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Shipment entity.'))
      ->setReadOnly(TRUE);
    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Shipment entity.'))
      ->setReadOnly(TRUE);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Shipment entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setDefaultValueCallback('Drupal\node\Entity\Node::getCurrentUserId')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => array(
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ),
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['order_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Order'))
      ->setDescription(t('The parent order.'))
      ->setSetting('target_type', 'commerce_order')
      ->setReadOnly(TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Shipment entity.'))
      ->setSettings(array(
        'max_length' => 50,
        'text_processing' => 0,
      ))
      ->setDefaultValue('')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['status'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Status'))
      ->setDescription(t('A string with the shipment status.'))
      ->setDefaultValue('pending');

    $fields['langcode'] = BaseFieldDefinition::create('language')
      ->setLabel(t('Language code'))
      ->setDescription(t('The language code for the Shipment entity.'))
      ->setDisplayOptions('form', array(
        'type' => 'language_select',
        'weight' => 10,
      ))
      ->setDisplayConfigurable('form', TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    $fields['shipping_rate'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Rate'))
      ->setDescription(t('The selected rate for the shipment.'))
      ->setSettings(array(
        'max_length' => 50,
        'text_processing' => 0,
      ))
      ->setDefaultValue('')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
    return $fields;
  }

  public function addShipmentItem($line_item, $quantity) {
    $this->setShipmentItems($line_item);
    return $this;
  }

}
