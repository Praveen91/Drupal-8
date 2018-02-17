<?php

namespace Drupal\custom_table\Controller;

class DisplayUserData {
  public function tableuser() {

    $query = \Drupal::database()->select('users_field_data', 'u');
    $query->fields('u', ['uid', 'name', 'mail']);

    // for the pagination we nneed to extend the pagerselectExtender.
    // and Limit in the query.
    $pager = $query->extend('Drupal\Core\Database\Query\PagerSelectExtender')->limit(10);

    $results = $pager->execute()->fetchAll();

    $header = [
     'userid' => t('User id'),
     'Username' => t('username'),
     'email' => t('Email'),
     ];

     // Initialize an empty array.

     $output = [];

     // Loop through the result array.

     foreach ($results as $result) {
       if ($result->uid != 0 && $result->uid != 1) {
         $output[$result->uid] = [
          'userid' => $result->uid, // 'userid' was the key used in the header
          'Username' => $result->name, // same for this
          'email' => $result->mail,  // 'email' was the key used in the header
         ];
       }
     }

     $form['table'] = [
      '#type' => 'table',
      '#tableselect' => TRUE,
      '#header' => $header,
      '#options' => $output,
      '#empty' => t('No users found'),
    ];

     // Finally add the pager.
    $form['pager'] = array(
      '#type' => 'pager'
    );
    return $form;
    // https://www.drupal.org/node/1876710
  }
}
