<?php

namespace Drupal\commerce_shipping\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Shipment item edit forms.
 *
 * @ingroup commerce_shipping
 */
class ShipmentItemForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\commerce_shipping\Entity\ShipmentItem */
    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Shipment item.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Shipment item.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.commerce_shipment_item.canonical', ['shipment_item' => $entity->id()]);
  }

}
