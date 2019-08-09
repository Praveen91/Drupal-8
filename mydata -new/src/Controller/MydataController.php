<?php

namespace Drupal\mydata\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class MydataController.
 */
class MydataController extends ControllerBase
{
	/**
	 * Display.
	 *
	 * @return string
	 * 
	 *   Return Hello string.
	 */

	public function display() {
		return [
         '#type' => 'markup',
         '#markup' => $this->t('This page contain all information about my data')
		];
	}
	
}