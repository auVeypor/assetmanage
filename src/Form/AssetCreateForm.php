<?php

namespace Drupal\assetmanage\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class AssetCreateForm.
 *
 * @package Drupal\assetmanage\Form
 */
class AssetCreateForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'asset_create_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

  }

}
