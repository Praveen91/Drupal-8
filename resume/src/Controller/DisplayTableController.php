<?php

namespace Drupal\resume\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Url;

class DisplayTableController extends ControllerBase {

    public function getContent() {
    // First we'll tell the user what's going on. This content can be found
    // in the twig template file: templates/description.html.twig.
    // @todo: Set up links to create nodes and point to devel module.
    $build = [
      'description' => [
        '#theme' => 'resume_description',
        '#description' => 'foo',
        '#attributes' => [],
      ],
    ];
    return $build;
  }

  /**
   * Display.
   *
   * @return string
   *   Return Hello string.
   */
  public function display() {
    /**return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: display with parameter(s): $name'),
    ];*/
    //create table header
    $header_table = array(
     'id'=>    t('SrNo'),
      'candidate_name' => t('Name'),
      'candidate_phone' => t('MobileNumber'),
      'candidate_email'=>t('Email'),
      'candidate_dob' => t('Date of Birth'),
      'candidate_gender' => t('Gender'),
      'opt' => t('operations'),
      'opt1' => t('operations'),
    );

   //select records from table

    $query = \Drupal::database()->select('candidate_resume', 'cr');
    $query->fields('cr', [
      'id',
      'candidate_name',
      'candidate_email',
      'candidate_phone',
      'candidate_dob',
      'candidate_gender'
    ]);

    $results = $query->execute()->fetchAll();
    $rows = [];

    foreach($results as $data) {
        $delete = Url::fromUserInput('/resume/form/delete/'.$data->id);
        $edit   = Url::fromUserInput('/resume/form/mydata?num='.$data->id);

        //print the data from table
             $rows[] = array(
            'id' =>$data->id,
            'candidate_name' => $data->candidate_name,
            'candidate_phone' => $data->candidate_phone,
            'candidate_email' => $data->candidate_email,
            'candidate_dob' => $data->candidate_dob,
            'candidate_gender' => $data->candidate_gender,
             \Drupal::l('Delete', $delete),
             \Drupal::l('Edit', $edit),
            );
    }

     //display data in site
        $form['table'] = [
            '#type' => 'table',
            '#header' => $header_table,
            '#rows' => $rows,
            '#empty' => t('No users found'),
            ];
            return $form;

}


}
