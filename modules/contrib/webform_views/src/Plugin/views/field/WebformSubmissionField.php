<?php

namespace Drupal\webform_views\Plugin\views\field;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;
use Drupal\webform\Plugin\WebformElementManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Webform submission field.
 *
 * @ViewsField("webform_submission_field")
 */
class WebformSubmissionField extends FieldPluginBase {

  /**
   * @var EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * @var WebformElementManagerInterface
   */
  protected $webformElementManager;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager'),
      $container->get('plugin.manager.webform.element')
    );
  }

  /**
   * WebformSubmissionField constructor.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entity_type_manager, WebformElementManagerInterface $webform_element_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->entityTypeManager = $entity_type_manager;
    $this->webformElementManager = $webform_element_manager;
  }

  /**
   * {@inheritdoc}
   */
  protected function defineOptions() {
    $options = parent::defineOptions();

    $options['webform_element_format'] = ['default' => ''];
    $options['webform_multiple_value'] = ['default' => TRUE];
    $options['webform_multiple_delta'] = ['default' => 0];

    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    $form['webform_multiple_value'] = [
      '#type' => 'radios',
      '#title' => $this->t('In this field show'),
      '#options' => [
        1 => $this->t('All multiple values'),
        0 => $this->t('A value that corresponds to specific delta'),
      ],
      '#default_value' => $this->options['webform_multiple_value'],
      '#required' => TRUE,
      '#access' => $this->definition['multiple'],
    ];

    $form['webform_multiple_delta'] = [
      '#type' => 'number',
      '#title' => $this->t('Delta'),
      '#description' => $this->t('Specify which delta to use for this field.'),
      '#required' => TRUE,
      '#default_value' => $this->options['webform_multiple_delta'],
      '#access' => $this->definition['multiple'],
      '#states' => [
        'visible' => [
          ':input[name$="[webform_multiple_value]"]' => ['value' => 0],
        ],
      ],
    ];

    $form['webform_element_format'] = [
      '#type' => 'select',
      '#title' => $this->t('Format'),
      '#description' => $this->t('Specify how to format this value.'),
      '#options' => $this->getWebformElementPlugin()->getItemFormats(),
      '#default_value' => $this->options['webform_element_format'] ?: $this->getWebformElementPlugin()->getItemDefaultFormat(),
    ];

    $form['webform_element_format']['#access'] = !empty($form['webform_element_format']['#options']);
  }

  /**
   * {@inheritdoc}
   */
  public function query() {
    // Since we will render the field off webform_submission entity, there is no
    // need to join any table nor include any fields in the select.
  }

  /**
   * {@inheritdoc}
   */
  public function render(ResultRow $values) {
    /** @var \Drupal\webform\WebformSubmissionInterface $webform_submission */
    $webform_submission = $this->getEntity($values);

    if ($webform_submission && $webform_submission->access('view')) {
      $webform = $webform_submission->getWebform();

      // Get format and element key.
      $format = $this->options['webform_element_format'];
      $element_key = $this->definition['webform_submission_field'];

      // Get element and element handler plugin.
      $element = $webform->getElement($element_key,TRUE);
      if (!$element) {
        return [];
      }

      // Set the format.
      $element['#format'] = $format;

      // Get element handler and get the element's HTML render array.
      $element_handler = $this->webformElementManager->getElementInstance($element);

      $options = [];
      if (!$this->options['webform_multiple_value']) {
        $options['delta'] = $this->options['webform_multiple_delta'];
      }

      return $element_handler->formatHtml($element, $webform_submission, $options);
    }

    return [];
  }

  /**
   * Retrieve webform element plugin instance.
   *
   * @return \Drupal\webform\Plugin\WebformElementInterface
   *   Webform element plugin instance that corresponds to the webform element
   *   of this view field
   */
  protected function getWebformElementPlugin() {
    $webform = $this->entityTypeManager->getStorage('webform')->load($this->definition['webform_id']);
    $element = $webform->getElement($this->definition['webform_submission_field']);
    return $this->webformElementManager->getElementInstance($element);
  }

}
