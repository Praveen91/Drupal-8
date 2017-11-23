<?php

/**
 * Build custom form
 */

namespace Drupal\mydata\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Url;

/**
 * Class MydataForm.
 *
 * @package Drupal\mydata\Form
 */
class MydataForm extends FormBase {
/**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mydata_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = [];

    $conn = Database::getConnection();

    $record = [];

    if (isset($_GET['num'])) {
      $query = $conn->select('mydata', 'm')
            ->condition('id', $_GET['num'])
            ->fields('m');
      $result = $query->execute()->fetchAssoc();

    }

    $form['candidate_name'] = [
      '#type' => 'textfield',
      '#title' => t('Condidate name'),
      '#required' => TRUE,
      '#default_value' => (isset($result['name']) && $_GET['num']) ? $result['name'] : '',
    ];
    $form['mobile_number'] = array(
      '#type' => 'textfield',
      '#title' => t('Mobile Number:'),
      '#default_value' => (isset($result['mobilenumber']) && $_GET['num']) ? $result['mobilenumber'] : '',
      );
    $form['candidate_mail'] = array(
      '#type' => 'email',
      '#title' => t('Email ID:'),
      '#required' => TRUE,
      '#default_value' => (isset($result['email']) && $_GET['num']) ? $result['email'] : '',
      );
    $form['candidate_age'] = array (
      '#type' => 'textfield',
      '#title' => t('Age'),
      '#required' => TRUE,
      '#default_value' => (isset($result['age']) && $_GET['num']) ? $result['age'] : '',
       );
    $form['candidate_gender'] = array (
      '#type' => 'select',
      '#title' => ('Gender'),
      '#options' => array(
        'Female' => t('Female'),
        'male' => t('Male'),
        ),
      '#default_value' => (isset($result['gender']) && $_GET['num']) ? $result['gender'] : '',
      );
    $form['web_site'] = array (
      '#type' => 'textfield',
      '#title' => t('web site'),
      '#default_value' => (isset($result['website']) && $_GET['num']) ? $result['website'] : '',
       );

    $form['actions']['submit'] = [
        '#type' => 'submit',
        '#value' => t('Save'),
    ];
    $cancel = Url::fromUserInput('/mydata/hello/table');
    $link = \Drupal::l('Cancel', $cancel);
    $form['actions']['cancel'] = array(
        '#markup' => $link,


    );

   return $form;
  }

   /**
    * {@inheritdoc}
    */
  public function validateForm(array &$form, FormStateInterface $form_state) {

   $name = $form_state->getValue('candidate_name');
   if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
   $form_state->setErrorByName('candidate_name', $this->t('Only letters and white space allowed'));
   }

   if (!intval($form_state->getValue('candidate_age'))) {
     $form_state->setErrorByName('candidate_age', $this->t('Age needs to be a number'));
   }

   if (strlen($form_state->getValue('mobile_number')) < 10) {
    $form_state->setErrorByName('mobile_number', $this->t('Your mobile number must in 10 digits'));

   }

     //kint($form_state); exit;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $field = $form_state->getValues();

    $name = $field['candidate_name'];
    $mobile = $field['mobile_number'];
    $mail = $field['candidate_mail'];
    $age = $field['candidate_age'];
    $gender = $field['candidate_gender'];
    $web_site = $field['web_site'];

   if (isset($_GET['num'])) {
       $field = [
        'name'   =>  $name,
        'mobilenumber' =>  $mobile,
        'email' =>  $mail,
        'age' => $age,
        'gender' => $gender,
        'website' => $web_site,
      ];

      $query = \Drupal::database();
      $query->update('mydata')
            ->fields($field)
            ->condition('id', $_GET['num'])
            ->execute();
      drupal_set_message('succesfully Updated');
      $form_state->setRedirect('mydata.display_table_controller_display');


    }
    else {
      $field = [
        'name'   =>  $name,
        'mobilenumber' =>  $mobile,
        'email' =>  $mail,
        'age' => $age,
        'gender' => $gender,
        'website' => $web_site,
      ];

    $query = \Drupal::database();
    $query->insert('mydata')
          ->fields($field)
          ->execute();
    drupal_set_message("succesfully saved");
    //$response = new RedirectResponse("../hello/table");
   // $response->send();
    $form_state->setRedirect('mydata.display_table_controller_display');

    }
     //kint($field['candidate_name']); exit();
  }

}
