<?php

/**
 * Implementation of hook_views_data()
 */
function hook_views_data() {
 $data = array(); 
 $data['customer_address']['table']['group'] = t('IOT Orders Table');

 $data['customer_address']['table']['base'] = array(
    'field' => 'id', // This is the identifier field for the view.
    'title' => t('IOT Orders Table'),
    'help' => t('IOT Orders Table table contains content and can be related to orders.'),
    'weight' => -10,
  );

 $data['customer_address']['order_id'] = array(
    'title' => t('Order ID'),
    'relationship' => array(
      'base' => 'commerce_order',
      'base field' => 'order_id',
      'handler' => 'views_handler_relationship',
      'skip base' => 'commerce_order',
    ),
  );

 $data['customer_address']['company_id'] = array(
    'title' => t('Company ID'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE, // This is use by the table display plugin.
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_numeric',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_numeric',
    ),
  );

 $data['customer_address']['quantity'] = array(
    'title' => t('Quantity'),
    'help' => t('Just a plain text field.'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE, // This is use by the table display plugin.
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_string',
    ),
  );

  $data['customer_address']['full_name'] = array(
    'title' => t('Full Name'),
    'help' => t('Customer full name.'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
  );

  $data['customer_address']['status'] = array(
    'title' => t('Order status'),
    'help' => t('IOT table order status.'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_numeric',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
  );

  $data['customer_address']['reason'] = array(
    'title' => t('Reason'),
    'help' => t('IOT table reason.'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
  );

  return $data;
}

/**
 * Implements hook_views_plugins().
 */
function hook_views_plugins() {
  return array(
    'argument default' => array(
      'company_id' => array(
        'title' => t("Current company id"),
        'handler' => 'mymodule_plugin_argument_default_current_company_id',
      ),
    ),
  );
}


/**
 * Definition mymodule_filter_plugin_argument_default_current_company_id.
 *
 * @ingroup views_argument_default_plugins
 */
class mymodule_iot_plugin_argument_default_current_company_id extends views_plugin_argument_default {
 
  /**
   * {@inheritdoc}
   */
  public function get_argument() {
  	 // Load the company if there is a company in context.
     $company = apigee_company_get_current_context_company();
   if ( !empty($company)) {
      return $value = $company->name;
    } else {
      return $value = FALSE;
    }
  }
}