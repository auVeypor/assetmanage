<?php

namespace Drupal\assetmanage\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Asset entities.
 */
class AssetViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['asset']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Asset'),
      'help' => $this->t('The Asset ID.'),
    );

    return $data;
  }

}
