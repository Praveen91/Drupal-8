<?php

/**
 * @file
 * CustomModalController class.
 */

namespace Drupal\custom_modal\Controller;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;


class CustomModalController extends ControllerBase {

  public function modal() {
    $options = [
      'dialogClass' => 'popup-dialog-class',
      'width' => '50%',
    ];

    $nid = 1;
    $node = Node::load($nid);

    $response = new AjaxResponse();
    $response->addCommand(new OpenModalDialogCommand(t('Modal title'), $node->body->value, $options));

    return $response;
  }
}
