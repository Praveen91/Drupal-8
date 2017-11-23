
## Drupal 8 Custom form with CRUD Operation

We are using bellow method and function for this module


Files : 

mydata.info.yml
mydata.install
mydata.routing.yml

src
 Controller
  DisplayTableController.php
  
 Form 
 MydataForm.php
 DeleteForm.php


hook_schema(). // For creating table

public function getFormId()  // For creating unique form id

public function buildForm(array $form, FormStateInterface $form_state) // For Building form

public function validateForm(array &$form, FormStateInterface $form_state)

public function submitForm(array &$form, FormStateInterface $form_state)
