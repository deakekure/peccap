<?php
namespace Report\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\Stdlib\Hydrator\ClassMethods;
use Report\Form\Object\AnnualPeriodSelection as AnnualPeriodSelectionObject;

class AnnualPeriodSelection extends Fieldset {
	public function __construct() {
		parent::__construct('annualReportSelection');
	}
	
	public function init() {
		$this->setHydrator(new ClassMethods(false));
		$this->setObject(new AnnualPeriodSelectionObject());
		
		$this->add(array(
			'name' => 'selection',
			'type' => 'checkbox',
			'options' => array(
				'use_hidden_element' => true,
				'checked_value' => 1,
				'unchecked_value' => 0
			)
		));
		
		$this->add(array(
			'name' => 'annualPeriod',
			'type' => 'Application\Form\Fieldset\AnnualPeriod'
		));
	}
}