<?php

namespace Drupal\mydata\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Url;

/**
 * Class DisplayTableData.
 */
class DisplayTableData extends ControllerBase {
	
	/**
	 * displaytable.
	 *
	 * @return string
	 *   Return Hello string.
	 */
	public function displaytable()	{
		
		//create table header

		$header_table = array(
         'id' => t('SrNo'),
         'name' => t('Name'),
         'mobilenumber' => t('Phone no'),
         'email' => t('Email'),
         'age' => t('Age'),
         'gender' => t('Gender'),
         //'website' => t('Website'),
         'opt' => t('Operrations'),
         'opt1' => t('Operrations'),
		);

		//select records from db
		$query = \Drupal::database()->select('mydata', 'm');
		$query->fields('m', ['id','name','mobilenumber','email','age','gender','website']);
		$results = $query->execute()->fetchAll();
		$rows=array();

		foreach ($results as $data) {
			$delete = Url::fromUserInput('/mydata/form/delete/'.$data->id);
            $edit   = Url::fromUserInput('/mydata/form/mydata?num='.$data->id);

            //print the data from table
             $rows[] = array(
                'id' =>$data->id,
                'name' => $data->name,
                'mobilenumber' => $data->mobilenumber,
                'email' => $data->email,
                'age' => $data->age,
                'gender' => $data->gender,
               // 'website' => $data->website,
                 \Drupal::l('Delete', $delete),
                 \Drupal::l('Edit', $edit),
            );
		}
               $form['link'] = 'link';
				//display data in site
		       $form['table'] = [
		            '#type' => 'table',
		            '#header' => $header_table,
		            '#rows' => $rows,
		            '#empty' => t('No users found'),
		        ];
		//        echo '<pre>';print_r($form['table']);exit;
		        return $form;
	}
}