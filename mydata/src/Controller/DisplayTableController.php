<?php

namespace Drupal\mydata\Controller;

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
        '#theme' => 'mydata_description',
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

    $header_table = [
      'id' => t('S.No.'),
      'name' => t('Name'),
      'mobilenumber' => t('Mobile No.'),
      'email' => t('Email'),
      'age' => t('Age'),
      'gender' => t('Gender'),
      'website' => t('Website'),
      'edit' => t('Operations'),
      'delete' => t('Operations'),
    ];

    //select records from table
     $query = \Drupal::database()->select('mydata', 'm');
     $query->fields('m', ['id','name','mobilenumber','email','age','gender','website']);
     $results = $query->execute()->fetchAll();
     $rows = [];
     foreach ($results as $data) {

      $delete = Url::fromUserInput('/mydata/form/delete/'.$data->id);
      $edit   = Url::fromUserInput('/mydata/form/mydata?num='.$data->id);
      //print the data from table

      $rows[] = [
        'id' => $data->id,
        'name' => $data->name,
        'mobilenumber' => $data->mobilenumber,
        'email' => $data->email,
        'age' => $data->age,
        'gender' => $data->gender,
        'website' => $data->website,
        \Drupal::l('Delete', $delete),
        \Drupal::l('Edit', $edit),
      ];

     }
     $add = Url::fromUserInput('/mydata/form/mydata');
     $link = \Drupal::l('New Add', $add);
     $form['markup'] = [
        '#type' => 'markup',
        '#markup' => $link,
     ];
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
