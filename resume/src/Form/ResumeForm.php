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
       '#type' => 'email',
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

      $name = $form_state->getValue('candidate_name');
      if(preg_match('/[^A-Za-z]/', $name)) {
         $form_state->setErrorByName('candidate_name', $this->t('your name must in characters without space'));
      }

      if (!intval($form_state->getValue('candidate_phone'))) {
             $form_state->setErrorByName('candidate_age', $this->t('Age needs to be a number'));
      }
    //parent::validateForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
	 /*foreach ($form_state->getValues() as $key => $value) {
	      drupal_set_message($key . ': ' . $value);
	    }*/
     $account = \Drupal::currentUser();
     $fields = $form_state->getValues();
     $name = $fields['candidate_name'];
     //echo $account->id(); exit();  //Praveen

     $mail = $fields['candidate_email'];
     $mobile = $fields['candidate_phone'];
     $dob = strtotime($fields['candidate_dob']);
     $gender = $fields['candidate_gender'];
     $confirm = $fields['candidate_confirmation'];
     $copy = $fields['candidate_copy'];
//echo time(); exit();
     $field = [
      'uid' => $account->id(),
      'candidate_name' => $name,
      'candidate_email' => $mail,
      'candidate_phone' => $mobile,
      'candidate_dob' => $dob,
      'candidate_gender' => $gender,
      'candidate_confirmation' => $confirm,
      'candidate_copy' => $copy,
      'created' => time(),
     ];

     $query = \Drupal::database();
     $query->insert('candidate_resume')
           ->fields($field)
           ->execute();
     drupal_set_message('Candidate Resume Data has been saved.');

  }

}
