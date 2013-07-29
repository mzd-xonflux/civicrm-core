<?php
/**
 * Test Generated example of using contact create API
 * /*this demonstrates the usage of chained api functions.  Specifically it has one 'parent function' &
    2 child functions - one receives values from the parent (Contact) and the other child (Tag).  *
 */
function contact_create_example(){
$params = array(
  'display_name' => 'batman',
  'contact_type' => 'Individual',
  'api.tag.create' => array(
      'name' => '$value.id',
      'description' => '$value.display_name',
      'format.only_id' => 1,
    ),
  'api.entity_tag.create' => array(
      'tag_id' => '$value.api.tag.create',
    ),
);

try{
  $result = civicrm_api3('contact', 'create', $params);
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
function contact_create_expectedresult(){

  $expectedResult = array(
  'is_error' => 0,
  'version' => 3,
  'count' => 1,
  'id' => 1,
  'values' => array(
      '1' => array(
          'id' => '1',
          'contact_type' => 'Individual',
          'contact_sub_type' => '',
          'do_not_email' => 0,
          'do_not_phone' => 0,
          'do_not_mail' => 0,
          'do_not_sms' => 0,
          'do_not_trade' => 0,
          'is_opt_out' => 0,
          'legal_identifier' => '',
          'external_identifier' => '',
          'sort_name' => '',
          'display_name' => 'batman',
          'nick_name' => '',
          'legal_name' => '',
          'image_URL' => '',
          'preferred_communication_method' => '',
          'preferred_language' => 'en_US',
          'preferred_mail_format' => 'Both',
          'hash' => '67eac7789eaee00',
          'api_key' => '',
          'first_name' => '',
          'middle_name' => '',
          'last_name' => '',
          'email_greeting_id' => '1',
          'email_greeting_custom' => '',
          'email_greeting_display' => '',
          'postal_greeting_id' => '1',
          'postal_greeting_custom' => '',
          'postal_greeting_display' => '',
          'addressee_id' => '1',
          'addressee_custom' => '',
          'addressee_display' => '',
          'job_title' => '',
          'gender_id' => '',
          'birth_date' => '',
          'is_deceased' => 0,
          'deceased_date' => '',
          'household_name' => '',
          'primary_contact_id' => '',
          'organization_name' => '',
          'sic_code' => '',
          'user_unique_id' => '',
          'created_date' => '2013-07-28 08:49:19',
          'modified_date' => '2012-11-14 16:02:35',
          'api.tag.create' => 6,
          'api.entity_tag.create' => array(
              'is_error' => 0,
              'not_added' => 1,
              'added' => 1,
              'total_count' => 2,
            ),
        ),
    ),
);

  return $expectedResult;
}


/*
* This example has been generated from the API test suite. The test that created it is called
*
* testChainingValuesCreate and can be found in
* http://svn.civicrm.org/civicrm/trunk/tests/phpunit/CiviTest/api/v3/ContactTest.php
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