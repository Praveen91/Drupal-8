<?php

namespace Drupal\ajax_example\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;

class AjaxFormExample extends FormBase {

    public function getFormId() {
    	return 'ajax_example_form';
    } 

    public function BuildForm(array $form, FormStateInterface $form_state) {
     $form['username'] = [
      '#title' => $this->t('User or Email'),
      '#type' => 'textfield',
      '#description' => 'Please enter in a user or email',
      '#prefix' => '<div id="user-email-result"></div>',
      '#ajax' => [
          'callback' => '::checkUserEmailValidation',
          'effect' => 'fade',
          'progress' => [
             'type' => 'throbber',
             'message' => NULL,
            ],
         ],
     ]; 

     return $form;
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
    	
    }

    public function checkUserEmailValidation(array $form, FormStateInterface $form_state) {

    	$ajax_response = new AjaxResponse();
 
  // Check if User or email exists or not
   if (user_load_by_name($form_state->getValue('username')) || user_load_by_mail($form_state->getValue('username'))) {
           $text = 'User or Email is exists';
           } else {
           $text = 'User or Email does not exists';
         }
        $ajax_response->addCommand(new HtmlCommand('#user-email-result', $text));
        return $ajax_response;
      }
 
}