<?php
/**
 * Test Generated example of using custom_field create API
 * *
 */
function custom_field_create_example(){
$params = array(
  'custom_group_id' => 1,
  'name' => 'test_textfield2',
  'label' => 'Name1',
  'html_type' => 'Text',
  'data_type' => 'String',
  'default_value' => 'abc',
  'weight' => 4,
  'is_required' => 1,
  'is_searchable' => 0,
  'is_active' => 1,
);

try{
  $result = civicrm_api3('custom_field', 'create', $params);
}
catch (CiviCRM_API3_Exception $e) {
  // handle error here
  $errorMessage = $e->getMessage();
  $errorCode = $e->getErrorCode();
  $errorData = $e->getExtraParams();
  return array('error' => $errorMessage, 'error_code' => $errorCode, 'error_data' => $errorData);
}

return $result;
}

/**
 * Function returns array of result expected from previous function
 */
function custom_field_create_expectedresult(){

  $expectedResult = array(
  'is_error' => 0,
  'version' => 3,
  'count' => 1,
  'id' => 1,
  'values' => array(
      '1' => array(
          'id' => '1',
          'custom_group_id' => '1',
          'name' => 'Name1',
          'label' => 'Name1',
          'data_type' => 'String',
          'html_type' => 'Text',
          'default_value' => 'abc',
          'is_required' => '1',
          'is_searchable' => 0,
          'is_search_range' => 0,
          'weight' => '4',
          'help_pre' => '',
          'help_post' => '',
          'mask' => '',
          'attributes' => '',
          'javascript' => '',
          'is_active' => '1',
          'is_view' => 0,
          'options_per_line' => '',
          'text_length' => '',
          'start_date_years' => '',
          'end_date_years' => '',
          'date_format' => '',
          'time_format' => '',
          'note_columns' => '',
          'note_rows' => '',
          'column_name' => 'name1_1',
          'option_group_id' => '',
          'filter' => '',
        ),
    ),
);

  return $expectedResult;
}


/*
* This example has been generated from the API test suite. The test that created it is called
*
* testCustomFieldCreateWithEdit and can be found in
* http://svn.civicrm.org/civicrm/trunk/tests/phpunit/CiviTest/api/v3/CustomFieldTest.php
*
* You can see the outcome of the API tests at
* http://tests.dev.civicrm.org/trunk/results-api_v3
*
* To Learn about the API read
* http://book.civicrm.org/developer/current/techniques/api/
*
* and review the wiki at
* http://wiki.civicrm.org/confluence/display/CRMDOC/CiviCRM+Public+APIs
*
* Read more about testing here
* http://wiki.civicrm.org/confluence/display/CRM/Testing
*
* API Standards documentation:
* http://wiki.civicrm.org/confluence/display/CRM/API+Architecture+Standards
*/