<?php

namespace Drupal\mydata\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'AddDataLink' Block.
 *
 * @Block(
 *   id = "add_data_link",
 *   admin_label = @Translation("Hello block"),
 *   category = @Translation("Hello World"),
 * )
 */
class AddDataLink extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#markup' => $this->t('Hello, World!'),
    ];
  }

 }