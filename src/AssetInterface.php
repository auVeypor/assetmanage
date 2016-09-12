<?php

namespace Drupal\assetmanage;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Asset entities.
 *
 * @ingroup assetmanage
 */
interface AssetInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Asset name.
   *
   * @return string
   *   Name of the Asset.
   */
  public function getName();

  /**
   * Sets the Asset name.
   *
   * @param string $name
   *   The Asset name.
   *
   * @return \Drupal\assetmanage\AssetInterface
   *   The called Asset entity.
   */
  public function setName($name);

  /**
   * Gets the Asset creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Asset.
   */
  public function getCreatedTime();

  /**
   * Sets the Asset creation timestamp.
   *
   * @param int $timestamp
   *   The Asset creation timestamp.
   *
   * @return \Drupal\assetmanage\AssetInterface
   *   The called Asset entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Asset published status indicator.
   *
   * Unpublished Asset are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Asset is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Asset.
   *
   * @param bool $published
   *   TRUE to set this Asset to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\assetmanage\AssetInterface
   *   The called Asset entity.
   */
  public function setPublished($published);

}
