<?php

namespace Drupal\ercore_core\Form;

/**
 * @file
 * Contains Drupal\ercore\Form\ERCoreAdmin.
 */

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ERCoreAdmin.
 *
 * Defines ERCore admin page.
 *
 * @package Drupal\ercore\Form
 */
class ERCoreAdmin extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'ercore.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ercore_admin_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('ercore.settings');
    $form['ercore_epscor_start'] = array(
      '#title' => t('Grant Start Date'),
      '#description' => $this->t('The start date for form processing and exports.'),
      '#type' => 'date',
      '#default_value' => $config->get('ercore_epscor_start'),
    );
    $form['ercore_epscor_number'] = [
      '#type' => 'textfield',
      '#title' => $this->t('EPSCoR Grant Number'),
      '#description' => $this->t('EPSCoR or NSF Grant Number for display and exported forms.'),
      '#default_value' => $config->get('ercore_epscor_number'),
    ];
    $form['ercore_reporting_month'] = [
      '#type' => 'select',
      '#title' => $this->t('Reporting period start month'),
      '#description' => $this->t('Reporting month may differ from start month above.'),
      '#default_value' => $config->get('ercore_reporting_month'),
      '#options' => [
        '01' => 'January',
        '02' => 'February',
        '03' => 'March',
        '04' => 'April',
        '05' => 'May',
        '06' => 'June',
        '07' => 'July',
        '08' => 'August',
        '09' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December',
      ],
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('ercore.settings')
      ->set('ercore_epscor_number', $form_state->getValue('ercore_epscor_number'))
      ->set('ercore_epscor_start', $form_state->getValue('ercore_epscor_start'))
      ->set('ercore_reporting_month', $form_state->getValue('ercore_reporting_month'))
      ->save();
  }

}
