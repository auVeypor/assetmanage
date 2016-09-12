<?php

namespace Drupal\assetmanage;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Asset entity.
 *
 * @see \Drupal\assetmanage\Entity\Asset.
 */
class AssetAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\assetmanage\AssetInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished asset entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published asset entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit asset entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete asset entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add asset entities');
  }

}
