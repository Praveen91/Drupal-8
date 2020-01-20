<?php

namespace Drupal\custom_page_title\Controller;

use Drupal\node\Entity\Node;


/**
 * Custom callback controller for title.
 */
class CustomTitleController {

	/**
	 * {@inheritdoc}
	 */
	public function dummy_page(){
        // Get content type of a node using node id.
		$nodeObj = entity_load('node', 4);
        $bundle = $nodeObj->bundle();

        //The below code will return all the available user roles as an array in drupal 8.
        $roles = array_map(['\Drupal\Component\Utility\Html', 'escape'], user_role_names(TRUE));

        //Get sitewide default email address by site config var.
        \Drupal::config('system.site')->get('mail');
        //Get sitename by site config var.
        $siteName = \Drupal::config('system.site')->get('name');


        //Get current user session
        \Drupal::service('session');

        //Accessing Node values and properties by loading.
        $node = Node::load(5);
       /* echo "<pre>";
        print_r($node);*/

        /*Node Properties:*/

		$id = $node->id();
		$title = $node->title->value;
		$vid = $node->vid->value;

		/*Node field values*/

		$field1 = $node->get('field_image')->getValue();
        $field2 = $node->get('title')->getValue();
        //kint($field2);


        //formatPlural(): Formatting count sentances with Singulars and Plural
        $title = PumaBox;
		$messageSingular = "Purchase @count more :title and save an additional 10.00$ per item!";
		$messagePlural = "Purchases @count more :title and save an additional 10.00$ per item!";
		 
		// Singular Example. Plural message will appeared if count value is more than 1
		$count = 4;
		//print \Drupal::translation()->formatPlural($count, $messageSingular, $messagePlural, array(':title' => $title));


		//Creating Hook Alters programatically with Example.

        $argu1 = 'Praveen';
        $argu2 = 'Kumar';
		\Drupal::moduleHandler()->invokeAll('change_my_name', array(&$argu1, &$argu2));

		//print_r($argu1);

        // Current user info.
		$account = \Drupal::currentUser();
        // Get user roles info.
		$account->getRoles();

		//get and set uuid using below command.
		//drush cget system.site uuid
        //drush cset system.site uuid -- id --

      Show Erros on Developing or WSOD(White Screen Of Death) 
        we need to add below lines in "settings.php".
        error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);


		//Drupal Inline Entity Form Module hook_form_alter()
		//The Inline entity form is the Drupal Contribute module. Which help to embed a entity form into another entity. Example: Commerce product add form cam be used in Node form. This module will help to create, update and delete entity based on its parent entity. 

		 //hook_inline_entity_form_entity_form_alter().

		//Setting up Private file system into settings.php
		//$settings['file_private_path'] = 'sites/default/files/private';

		//MERGE(INSERT+UPDATE) query

		$empId = 'CE 003';
		$empName = 'Kumar';
		$empAge = 25;
		 
		\Drupal::database()->merge('employee')
			->key(array('employee_id' => $empId))
			->insertFields(array(
				'employee_id' => $empId,
				'employee_name' => $empName,
				'employee_age' => $empAge,
			))
			->updateFields(array(
				'employee_name' => $empName,
				'employee_age' => $empAge,
			))->execute();


        //DELETE query
		$query = \Drupal::database()->delete('employee', 'emp');
	            ->condition('employee_id', 'CE 003')
	            ->execute();

	    //UPDATE query
	      \Drupal::database()->update('employee')
			->condition('employee_id' , 'CE 003')
			->updateFields([
				'employee_name' => 'Swathy',
				'employee_age' => 20,
			])
			->execute();

         //SELECT query

			$query = \Drupal::database()->select('employee', 'emp');
			$query->fields('emp', ['employee_id', 'employee_name', 'employee_age']);
			$result = $query->execute();
			while ($row = $result->fetchAssoc()) {
				$output .= $row['employee_id'];
				$output .= $row['employee_name'];
				$output .= $row['employee_age'];
			}

		//INSERT query

		// Insert the record to table.
		\Drupal::database()->insert('employee')
			->fields([
				'employee_id',
				'employee_name',
				'employee_age',
			])
			->values(array(
				'CE 003',
				'Kumar',
				25,
			))
			->execute();

		//List of Taxonomy Vocabularies.

		use Drupal\taxonomy\Entity\Vocabulary;
		--------------
		--------------
		$vocabularies = Vocabulary::loadMultiple();
		$vocabulariesList = [];
		foreach ($vocabularies as $vid => $vocablary) {
		  $vocabulariesList[$vid] = $vocablary->get('name');
		}
		print_r($vocabulariesList);



     //List of Content type

		// Loading list Content types storage information.
		$contentTypes = \Drupal::service('entity.manager')->getStorage('node_type')->loadMultiple();
		$contentTypesList = [];
		// Get content Type information.
		foreach ($contentTypes as $contentType) {
		  $contentTypesList[$contentType->id()] = $contentType->label();
		}
		print_r($contentTypesList);
		// Output
		Array (
		  article => Article,
		  basic_page => Basic page
		);




       //Programmatically create File in server
		
		$uri = 'public://myprofile.pdf';
		$wrapperObj = \Drupal::service('stream_wrapper_manager')->getViaUri($uri);
		$filePath = $wrapperObj->realpath();
		$fileContent = file_get_contents($filePath);
		$destination = "public://resumes/resume_001.pdf";
		 
		$file = file_save_data(
		  $fileContent,
		  $destination,
		  FILE_EXISTS_REPLACE
		);
		 
		if (is_object($file)) {
		  print "File created successfully";
		}
		else {
		  print "Error in file creation";
		}



		//Get file Real / Absolute path from URI

		$uri = 'public://myprofile.pdf';
		$wrapperObj = \Drupal::service('stream_wrapper_manager')->getViaUri($uri);
		$filePath = $wrapperObj->realpath();
		print_r(filePath);



        //Directory/Folder creation with permissions.
		//drupal_mkdir(“public://codeexpertz”, “777”);

		//Programmatically sent Mail.


		// Call below code in your function.
		$sentMail = \Drupal::service('plugin.manager.mail')->mail(MODULE_NAME, UNIQUE_KEY, TO_MAIL, LANGUAGE, PARAMETERS, REPLY, SEND);
		// Parameters
		MODULE_NAME - Module that send mail.
		UNIQUE_KEY - Unique Key identifying mail.
		TO_MAIL - Receiver mail ID.
		LANGUAGE - Message language.
		PARAMETERS - Contains mail subject and body.
		REPLY - Boolean value TRUE or FALSE for Reply or Not Reply.
		REPLY - Boolean value TRUE or FALSE for Send Mails.

		function MODULE_NAME_mail($key, &$message, $params) {
		if ($key == UNIQUE_KEY) {
		$message['from'] = FROM;
		$message['subject'] = PARAMETER_SUBJECT;
		$message['body'][] = PARAMETER_BODY;
		}
		}
		FROM - From Mail Id for the mail. 

		// exmple

		function faq_ask_node_update($node) {
		  // Get the asker account.
		  $email = 'test@example.com';
		  $account = user_load_by_mail($email);
		  $param = array();
		 
		  // Send the e-mail to the asker. Drupal calls hook_mail() via this.
		  $mail_sent = \Drupal::service('plugin.manager.mail')->mail('faq_ask', 'notify_asker', $email, $account->getPreferredLangcode(), $params, NULL, TRUE);
		 
		  // Handle sending result.
		  if ($mail_sent) {
		    print "Mail Sent successfully.";
		  }
		  else {
		   print "There is error in sending mail.";
		  }
		}
		 
		/**
		 * Implements hook_mail().
		 *
		 * This function completes the email, allowing for placeholder substitution.
		 */
		function faq_ask_mail($key, &$message, $params) {
		  if (($key == 'notify_asker') || ($key == 'notify_expert')) {
		    $message['from'] = 'info.codeexpertz@gmail.com';
		    $message['body'] = "This is Sample mail content for testing purpose from CodeExpertz";
		    $message['subject'] = "Test Mail from CodeExpertz";
		  }
		}


		//Alter system path with custom Paths.

		function codeexpertz_menu_alter(&$items) {
		 $items['node/add/article'] = $items['create/article'];
		 unset($items['node/add/article']);
		}


		// add Custom validtion function using form alter.


		use Drupal\Core\Form\FormStateInterface;

			/**
			 * Implements hook_form_FORM_ID_alter().
			 */
			function faq_ask_form_node_faq_form_alter(&$form, FormStateInterface $form_state) {
			  // Custom validate function.
			  $form['#validate'][] = 'faq_ask_form_validate';
			}
			 
			/**
			 * Validation form for the FAQ Ask form.
			 *
			 * Verifies that the e-mail entered seems to be a valid e-mail.
			 */
			function faq_ask_form_validate($form, FormStateInterface &$form_state) {
			  $email = $form_state->getValue('faq_email');
			  if (isset($email) && 2 < strlen($email)) {
			    if (!valid_email_address($email)) {
			      $form_state->setErrorByName('email', t('That is not a valid e-mail address.'));
			    }
			  }
			}




		return [
           '#type' => 'markup',
           '#markup' => 'Hello from our custom title controller form '. $bundle,
		];

	}

	/**
	 * {@inheritdoc}
	 */
	public function titleCallback(){
		 $randomTitleIndex = rand(0, 2);
	     $randomTitle = [
	      'This is a great page.',
	      'This is awful page',
	      'Is this a page?',
	     ];

	     return $randomTitle[$randomTitleIndex];
	}

}