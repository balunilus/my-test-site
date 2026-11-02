<?php

namespace Drupal\my_custom_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a form for collecting a person's name and email address.
 */
class BasicDetailsForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'my_custom_form_basic_details';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form['firstname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First name'),
      '#required' => TRUE,
      '#maxlength' => 255,
    ];

    $form['lastname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Last name'),
      '#required' => TRUE,
      '#maxlength' => 255,
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email address'),
      '#required' => TRUE,
      '#maxlength' => 254,
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $this->messenger()->addStatus($this->t('Thank you. Your details have been submitted.'));
  }

}
