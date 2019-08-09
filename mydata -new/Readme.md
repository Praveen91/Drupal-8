
#How To Create a Custom form with CRUD Operations?

#Required Methods
 FormBase implements FormInterface, and therefore any form that has FormBase in its hierarchy is required to implement a few methods:

 getFormId()
 buildForm()
 submitForm()


/**
 * Class MydataForm.
 *
 * @package Drupal\mydata\From
 */
class MydataForm extends FormBase {
	/**
	 * {@inheritdoc}
	 */
	public function getFormId() {
		return 'my_form';
	}

	/**
	 * {@inheritdoc}
	 */
	public function buildForm(array $form, FormStateInterface $form_state) {
  
   }

   /**
   * {@inheritdoc}
   */
   public function submitForm(array &$form, FormStateInterface $form_state) {

  }

}