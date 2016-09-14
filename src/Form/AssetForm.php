<?php

namespace Drupal\assetmanage\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\assetmanage\AssetInterface;
use Drupal\user\UserInterface;
use Drupal\user\Entity\User;


/**
 * Form controller for Asset edit forms.
 *
 * @ingroup assetmanage
 */
class AssetForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\assetmanage\Entity\Asset */
    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;

    $currentuid = \Drupal::currentUser()->id();
    $currentUser = User::load($currentuid);

    $currentPath = \Drupal::service('path.current')->getPath();
    $splitPath = explode('/', $currentPath);

    // \Drupal::logger('barp')->info($entity->isPublished());

    if($currentUser->hasRole('administrator')) {
      $form['separator1'] = array(
        '#type' => 'html_tag',
        '#tag' => 'p',
        '#value' => $this->t('<br>'),
        '#weight' => 98
      );
      $form['approved'] = array(
        '#type' => 'checkbox',
        '#title' => $this->t('Approved'),
        '#weight' => 99,
        '#description' => $this->t('Allows for this asset to be used in events.'),
      );

      if(end($splitPath) != 'add') {
        $form['approved']['#default_value'] = $entity->isPublished();
      }
    }

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
        drupal_set_message($this->t('Created the %label Asset.', [
          '%label' => $entity->label(),
        ]));

        $entity->setPublished(false);
        \Drupal::logger('barp')->info($entity->isPublished());
        $entity->save();
        break;

      default:
        drupal_set_message($this->t('Saved the %label Asset.', [
          '%label' => $entity->label(),
        ]));
        $entity->setPublished($form_state->getValue('approved'));
        $entity->save();
        
    }
    $form_state->setRedirect('entity.asset.canonical', ['asset' => $entity->id()]);
  }

}
