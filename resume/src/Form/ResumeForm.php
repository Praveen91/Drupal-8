<?php

namespace Drupal\resume\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ResumeForm extends FormBase {

  public function getFormId(){
  	return 'resume_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
     $form['candidate_name'] = [
       '#title' => $this->t('Candidate Name'),
       '#type' => 'textfield',
       '#required' => TRUE,
     ];
     $form['candidate_email'] = [
       '#title' => $this->t('Email'),
       '#type' => 'eamil',
       '#required' => TRUE,
     ];
     $form['candidate_phone'] = [
       '#title' => $this->t('Mobile'),
       '#type' => 'tel',
       '#required' => TRUE,
     ];

	$form['candidate_dob'] = [
	   '#title' => $this->t('Date Of Birth'),
       '#type' => 'date',
       '#required' => TRUE,
     ];

     $form['candidate_gender'] = [
      '#type' => 'select',
      '#title' => ('Gender'),
      '#options' => [
        'Female' =>  $this->t('Female'),
        'male' =>  $this->t('Male'),
      ],
    ];
    $form['candidate_confirmation'] = [
      '#type' => 'radios',
      '#title' => ('Are you above 18 years old?'),
      '#options' => [
        'Yes' => $this->t('Yes'),
        'No' => $this->t('No')
      ],
    ];
    $form['candidate_copy'] = [
      '#type' => 'checkbox',
      '#title' =>  $this->t('Send me a copy of the application.'),
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    ];
    
     return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
      if (strlen($form_state->getValue('candidate_phone')) < 10 ) {
      	$form_state->setErrorByName('candidate_phone', $this->t('Mobile No is too shrot'));
      }
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
	 foreach ($form_state->getValues() as $key => $value) {
	      drupal_set_message($key . ': ' . $value);
	    }
  }

}