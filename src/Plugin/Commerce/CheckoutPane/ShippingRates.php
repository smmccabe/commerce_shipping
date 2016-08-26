<?php

namespace Drupal\commerce_shipping\Plugin\Commerce\CheckoutPane;

use Drupal\commerce_checkout\Plugin\Commerce\CheckoutFlow\CheckoutFlowInterface;
use Drupal\commerce_checkout\Plugin\Commerce\CheckoutPane\CheckoutPaneBase;
use Drupal\commerce_shipping\Entity\Shipment;
use Drupal\Component\Utility\Html;
use Drupal\Component\Utility\NestedArray;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Render\RendererInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides the shipping rates pane.
 *
 * @CommerceCheckoutPane(
 *   id = "shipping_rates",
 *   label = @Translation("Shipping Rates"),
 *   default_step = "order_information",
 *   wrapper_element = "fieldset",
 * )
 */
class ShippingRates extends CheckoutPaneBase implements ContainerFactoryPluginInterface {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The renderer.
   *
   * @var \Drupal\Core\Render\RendererInterface
   */
  protected $renderer;

  /**
   * Constructs a new BillingInformation object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\commerce_checkout\Plugin\Commerce\CheckoutFlow\CheckoutFlowInterface $checkout_flow
   *   The parent checkout flow.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   * @param \Drupal\Core\Render\RendererInterface $renderer
   *   The renderer.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, CheckoutFlowInterface $checkout_flow, EntityTypeManagerInterface $entity_type_manager, RendererInterface $renderer) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $checkout_flow);

    $this->entityTypeManager = $entity_type_manager;
    $this->renderer = $renderer;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition, CheckoutFlowInterface $checkout_flow = NULL) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $checkout_flow,
      $container->get('entity_type.manager'),
      $container->get('renderer')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function buildPaneSummary() {
    $shipment = $this->order->getData()['shipment'];
    $order_id = $this->order->getOrderNumber();
    $rate = $shipment->getShippingRate();
    if (!$shipment) {
      return 'No Shipment Created.';
    }

    return 'Order ID: ' . $order_id . ' -- ' . 'Rate: ' . $rate;
  }

  /**
   * {@inheritdoc}
   */
  public function buildPaneForm(array $pane_form, FormStateInterface $form_state, array &$complete_form) {
    $options = [
      'flat_1' => 'Flat Rate: $5',
      'flat_2' => 'Flat Rate: $10',
      'flat_3' => 'Flat Rate: $15',
    ];
    $default_option = NULL;


    // Prepare the form for ajax.
    $pane_form['#wrapper_id'] = Html::getUniqueId('shipping-rates-wrapper');
    $pane_form['#prefix'] = '<div id="' . $pane_form['#wrapper_id'] . '">';
    $pane_form['#suffix'] = '</div>';

    $pane_form['shipping_rates'] = [
      '#type' => 'radios',
      '#title' => $this->t('Rates: '),
      '#options' => $options,
      '#default_value' => $options['test'],
      '#ajax' => [
        'callback' => [get_class($this), 'ajaxRefresh'],
        'wrapper' => $pane_form['#wrapper_id'],
      ],
    ];

    return $pane_form;
  }

  /**
   * Ajax callback.
   */
  public static function ajaxRefresh(array $form, FormStateInterface $form_state) {
    $parents = $form_state->getTriggeringElement()['#parents'];
    array_pop($parents);
    return NestedArray::getValue($form, $parents);
  }

  /**
   * {@inheritdoc}
   */
  public function submitPaneForm(array &$pane_form, FormStateInterface $form_state, array &$complete_form) {
    $values = $form_state->getValue($pane_form['#parents']);
    $rate = $values['shipping_rates'];
    $this->order->setData(array('shipment', ''));
    $shipment = Shipment::create();
    $shipment->setShippingRate($rate);
    $shipment->setName("Should see this");
    $this->order->setData(array('shipment' => $shipment));
  }
}
