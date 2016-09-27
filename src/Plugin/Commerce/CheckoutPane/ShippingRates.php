<?php

namespace Drupal\commerce_shipping\Plugin\Commerce\CheckoutPane;

use Drupal\commerce_checkout\Plugin\Commerce\CheckoutFlow\CheckoutFlowInterface;
use Drupal\commerce_checkout\Plugin\Commerce\CheckoutPane\CheckoutPaneBase;
use Drupal\commerce_price\Price;
use Drupal\commerce_shipping\Entity\Shipment;
use Drupal\commerce_shipping\Plugin\RateManager;
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
   * The payment gateway plugin manager.
   *
   * @var \Drupal\commerce_shipping\Plugin\RateManager
   */
  protected $pluginManager;

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
   * @param \Drupal\commerce_shipping\Plugin\RateManager $plugin_manager
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, CheckoutFlowInterface $checkout_flow, EntityTypeManagerInterface $entity_type_manager, RendererInterface $renderer, RateManager $plugin_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $checkout_flow);

    $this->entityTypeManager = $entity_type_manager;
    $this->renderer = $renderer;
    $this->pluginManager = $plugin_manager;
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
      $container->get('renderer'),
      $container->get('plugin.manager.rate')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function buildPaneSummary() {
    /** @var \Drupal\commerce_shipping\Entity\Shipment $shipment */
    $shipment = $this->order->shipment->entity;
    $rate = $shipment->getShippingRate();
    $method = $shipment->getShippingRateMethod();
    if (empty($rate) || empty($method)) {
      return 'No Shipment Created.';
    }

    return $method . ': ' . $rate->__toString();
  }

  /**
   * {@inheritdoc}
   */
  public function buildPaneForm(array $pane_form, FormStateInterface $form_state, array &$complete_form) {
    $definitions = $this->pluginManager->getDefinitions();

    foreach ($definitions as $method => $rate) {
      $price = new Price($rate['rate']['amount'], $rate['rate']['currency_code']);
      $options[$rate['id']] = $rate['label'] . ': ' . $price->__toString();
    }

    $default_option = key($options);

    // Prepare the form for ajax.
    $pane_form['#wrapper_id'] = Html::getUniqueId('shipping-rates-wrapper');
    $pane_form['#prefix'] = '<div id="' . $pane_form['#wrapper_id'] . '">';
    $pane_form['#suffix'] = '</div>';

    $pane_form['shipping_rates'] = [
      '#type' => 'radios',
      '#title' => $this->t('Rates: '),
      '#options' => $options,
      '#default_value' => $default_option,
      '#required' => TRUE,
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
    $selected_rate = $form_state->getValue($pane_form['#parents'])['shipping_rates'];
    $shipping_definitions = $this->pluginManager->getDefinitions();
    $label = $shipping_definitions[$selected_rate]['label'];
    $rate = $shipping_definitions[$selected_rate]['rate'];
    $price = new Price($rate['amount'], $rate['currency_code']);
    /** @var \Drupal\commerce_shipping\Entity\Shipment $shipment */
    $shipment = $this->order->shipment->entity;
    $shipment->setShippingRateMethod($label);
    $shipment->setShippingRate($price);
    $shipment->save();
    $this->order->shipment = $shipment;
    $this->order->save();
  }
}
