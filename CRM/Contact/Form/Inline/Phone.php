<?php
/*
 +--------------------------------------------------------------------+
 | CiviCRM version 4.4                                                |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2013                                |
 +--------------------------------------------------------------------+
 | This file is a part of CiviCRM.                                    |
 |                                                                    |
 | CiviCRM is free software; you can copy, modify, and distribute it  |
 | under the terms of the GNU Affero General Public License           |
 | Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
 |                                                                    |
 | CiviCRM is distributed in the hope that it will be useful, but     |
 | WITHOUT ANY WARRANTY; without even the implied warranty of         |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
 | See the GNU Affero General Public License for more details.        |
 |                                                                    |
 | You should have received a copy of the GNU Affero General Public   |
 | License and the CiviCRM Licensing Exception along                  |
 | with this program; if not, contact CiviCRM LLC                     |
 | at info[AT]civicrm[DOT]org. If you have questions about the        |
 | GNU Affero General Public License or the licensing of CiviCRM,     |
 | see the CiviCRM license FAQ at http://civicrm.org/licensing        |
 +--------------------------------------------------------------------+
*/

/**
 *
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2013
 * $Id$
 *
 */

/**
 * form helper class for an Phone object
 */
class CRM_Contact_Form_Inline_Phone extends CRM_Contact_Form_Inline {

  /**
   * phones of the contact that is been viewed
   */
  private $_phones = array();

  /**
   * No of phone blocks for inline edit
   */
  private $_blockCount = 6;

  /**
   * call preprocess
   */
  public function preProcess() {
    parent::preProcess();

    //get all the existing phones
    $phone = new CRM_Core_BAO_Phone();
    $phone->contact_id = $this->_contactId;

    $this->_phones = CRM_Core_BAO_Block::retrieveBlock($phone, NULL);
  }

  /**
   * build the form elements for phone object
   *
   * @return void
   * @access public
   */
  public function buildQuickForm() {
    parent::buildQuickForm();

    $totalBlocks = $this->_blockCount;
    $actualBlockCount = 1;
    if (count($this->_phones) > 1) {
      $actualBlockCount = $totalBlocks = count($this->_phones);
      if ($totalBlocks < $this->_blockCount) {
      $additionalBlocks = $this->_blockCount - $totalBlocks;
      $totalBlocks += $additionalBlocks;
    }
      else {
        $actualBlockCount++;
        $totalBlocks++;
      }
    }

    $this->assign('actualBlockCount', $actualBlockCount);
    $this->assign('totalBlocks', $totalBlocks);

    $this->applyFilter('__ALL__', 'trim');

    for ($blockId = 1; $blockId < $totalBlocks; $blockId++) {
      CRM_Contact_Form_Edit_Phone::buildQuickForm($this, $blockId, TRUE);
    }

    $this->addFormRule(array('CRM_Contact_Form_Inline_Phone', 'formRule'));
  }

  /**
   * global validation rules for the form
   *
   * @param array $fields     posted values of the form
   * @param array $errors     list of errors to be posted back to the form
   *
   * @return $errors
   * @static
   * @access public
   */
  static function formRule($fields, $errors) {
    $hasData = $hasPrimary = $errors = array();
    if (CRM_Utils_Array::value('phone', $fields) && is_array($fields['phone'])) {
      $primaryID = null;
      foreach ($fields['phone'] as $instance => $blockValues) {
        $dataExists = CRM_Contact_Form_Contact::blockDataExists($blockValues);

        if ($dataExists) {
          $hasData[] = $instance;
          if (CRM_Utils_Array::value('is_primary', $blockValues)) {
            $hasPrimary[] = $instance;
            if (!$primaryID &&
              CRM_Utils_Array::value('phone', $blockValues)) {
                $primaryID = $blockValues['phone'];
            }
          }
        }
      }

      if (empty($hasPrimary) && !empty($hasData)) {
        $errors["phone[1][is_primary]"] = ts('One phone should be marked as primary.');
      }

      if (count($hasPrimary) > 1) {
        $errors["phone[".array_pop($hasPrimary)."][is_primary]"] = ts('Only one phone can be marked as primary.');
      }
    }
    return $errors;
  }

  /**
   * set defaults for the form
   *
   * @return array
   * @access public
   */
  public function setDefaultValues() {
    $defaults = array();
    if (!empty($this->_phones)) {
      foreach ($this->_phones as $id => $value) {
        $defaults['phone'][$id] = $value;
      }
    }
    else {
      // get the default location type
      $locationType = CRM_Core_BAO_LocationType::getDefault();
      $defaults['phone'][1]['location_type_id'] = $locationType->id;
    }
    return $defaults;
  }

  /**
   * process the form
   *
   * @return void
   * @access public
   */
  public function postProcess() {
    $params = $this->exportValues();

    // Process / save phones
    $params['contact_id'] = $this->_contactId;
    $params['updateBlankLocInfo'] = TRUE;
    CRM_Core_BAO_Block::create('phone', $params);

    $this->log();
    $this->response();
  }
}
