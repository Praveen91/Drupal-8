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

        return [
           '#type' => 'markup',
           '#markup' => 'Hello from our custom title controller form '. $bundle,
		];


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


			// adding validate and submit custom handler for custom form.

			use Drupal\Core\Form\FormStateInterface;

			/**
			 * Implements hook_form_FORM_ID_alter().
			 */
			function faq_ask_form_node_faq_form_alter(&$form, FormStateInterface $form_state) {
			  // Custom validate function.
			  $form['#validate'][] = 'faq_ask_form_validate';
			   // Custom Submit function.
			  $form['actions']['submit']['#submit'][] = 'faq_ask_submit';
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
			 
			/**
			 * Handles the ask form submission.
			 */
			function faq_ask_submit($form, FormStateInterface $form_state) {
			  $user = \Drupal::currentUser();
			  if ($user->hasPermission('ask question') && !$user->hasPermission('answer question')) {
			    $node_id = $form_state->getValue('nid');
			    $node = node_load($node_id);
			    if (is_object($node)) {
			      $node->status->value = 0;
			      $node->save();
			    }
			  }
			}


			// Form Redirect in hook_form_alter()

			function hook_form_alter(&$form, \Drupal\Core\Form\FormStateInterface $form_state) {
			  $form_state->setRedirect(REDIRECT_URL);
			}

			//Encrypting String with Site Private Key.

			/*In Drupal 7 to encrypt the string we use the core function “drupal_hash_base64()”. This function have 2 parameters, Encrypting string and optional parameter of Site private key. But this function is deprecated in Drupal 8.   

		    In Drupal 8 we need to use the class Crypt from component utility for encryption. Similarly it have 2 parameters.*/

		    // Private Key.
			$privateKey = \Drupal::service('private_key')->get();
			print $privateKey;
			//Output
			GROlAqWtZ98EcKWRGMHalv6ynSvb0jqd5aOqJCOP_Uz8Vy8BBPY1PfzLXOpvlr3YScZgP6DFeQ
			 
			// Encryption of String with private key from site.
			$encrptionPrivate = Crypt::hmacBase64(‘codeexpertz’, \Drupal::service('private_key')->get());
			print $encrptionPrivate;
			//Output
			me6_sWh86-TqaKORnn9fMSETxJ0iWECWUO22hFbvZ_k


			//Loading User Roles and Check Role has Permission.

			//Loading Single and Multiple Roles:

				// Loading Single Role
			$role = \Drupal\user\Entity\Role::load(‘ROLE_ID’);
			print_r($role); // Return Specified Role as Object.
			// List out all roles from System.
			$roles = \Drupal\user\Entity\Role::loadMultiple();
			print_r($roles); // Return Roles as Object.


			// Loading administrator role.
			$roleObj =  \Drupal\user\Entity\Role::load('administrator');
			print_r($roleOb);
			 
			// List out all roles.
			$roles =  \Drupal\user\Entity\Role::loadMultiple();
			foreach ($roles as $role => $rolesObj) {
				$role_list[$role] = $rolesObj->get('label');
			}
			print_r($role_list);
			// Output
			Array
			(
			    [anonymous] => Anonymous user
			    [authenticated] => Authenticated user
			    [administrator] => Administrator
			)


			//Check Role have Permission:

			//Syntax:

			$roleObj = \Drupal\user\Entity\Role::load(‘ROLE_ID’);
			if ($roleObj->hasPermission("PERMISSION NAME")) {
			   // Role Has Permission.
			}
			else {
			   // Role Won't have permission.
			}
			
			//Example:

			// Get All users having the role of answer.
			$roles = \Drupal\user\Entity\Role::loadMultiple();
			foreach ($roles as $role => $roleObj) {
			  if ($roleObj->hasPermission("answer question")) {
				$role_list[$role] = $roleObj->get('label');
			  }
			}
			print_r($role_list); // List Roles have permission of 'answer question'.

			//Check Module Exist or Not.

			/*In Drupal 7 there function called module_exist(). This function returns true if module exist else return false. For Drupal 8 module_exist() function is Deprecated.

			In Drupal there is Core function moduleHandler() will more information about modules in Drupal system. The moduleHandler() returns a object, using this object we can call moduleExists() function with module name as parameter to the function.*/


			//Syntax:

			\Drupal::moduleHandler()->moduleExists(‘MODULE NAME’);
			//Example:

			$moduleHandler = \Drupal::moduleHandler();
			$moduleExist = $moduleHandler->moduleExists(‘simplenews’);
			if ($moduleExist) {
			print “simplenews Module Exist”;
			}
			else {
			print “simplenews Module Not Exist”;
			}

			//Writing your own Access denied

			//Syntax:

			use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
			 
			function callBackFunction() {
				// Inside callBackFunction
				throw new AccessDeniedHttpException();
			}

			//Page Redirection with Sample code.

		/*	In Drupal 8 fully works on OOPs concept. To create page redirection we need to use Symfony components class. The page redirection is done by RedirectResponse Class from Symfony HttpFoundation. This class object used inside function as a return parameter. While creating object we need to send valid site path to the constructor of RedirectResponse class.

            In Drupal 7 we using drupal_goto() function for redirect.*/

			//Syntax:

			use Symfony\Component\HttpFoundation\RedirectResponse;
			function callBackFunction() {
				// Inside callBackFunction
				return new RedirectResponse(“REDIRECT PATH”);
			}


			//Accessing User Roles and Custom User Permissions.
/*
			In Drupal 8 we create users permission using YML file of our module. It created as  MODULE.permission.yml. In this yml we specifying machine name, title,description for permission and access right.

*/


			  permission_machine_name:
			  title: 'PERMISSION TITLE'
			  description: 'PERMISSION DESCRIPTION'
			  restrict access: true (or) false

			  //List of Roles :
/*
				To get list of roles from our Drupal 8 system by calling the function user_role_names(). This function return as Associated array with key as Role machine and value as title of role.
*/
				Example:

				$roles_list = user_role_names();
				print_r($roles_list);
				// Output.
				Array
				(
				    [anonymous] => Anonymous user
				    [authenticated] => Authenticated user
				    [administrator] => Administrator
				)


				//Logging Messages and Errors.

				//Syntax:

				\Drupal::logger(‘MODULE_NAME’’)->notice($message, $valueArray); 
				\Drupal::logger('Faq_Ask')->notice("Asker notification email sent to @to for question @quest", array('@to' => $email, '@quest' => SafeMarkup::checkPlain($node_title))); 


				 \Drupal::logger(‘MODULE_NAME’’)->error($message, $valueArray); 


				 //Enabled Languages and Language codes.

/*
				 In Drupal 8 language related features are handled in core classes. To get list of languages that enabled in your Drupal 8 site using function languageManager.
*/
								 
				// Access all language in site.
				 
				$language = \Drupal::languageManager()->getCurrentLanguage();
				 
				print_r($language);
				 
				 
				// Get default language and its property.
				 
				$defaultLanguage = \Drupal::languageManager()->getCurrentLanguage();
				 
				print_r($language);
				 
				 
				// Default language Name.
				 
				$langName= \Drupal::languageManager()->getCurrentLanguage()->getName();
				 
				print $langName;
				 
				 
				// Default language Code.
				 
				$langCode= \Drupal::languageManager()->getCurrentLanguage()->getId();
				 
				print $langCode;





		

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