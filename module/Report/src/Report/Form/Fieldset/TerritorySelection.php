<?php
namespace Report\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\Stdlib\Hydrator\ClassMethods;
use Report\Form\Object\TerritorySelection as TerritorySelectionObject;

class TerritorySelection extends Fieldset {
	public function __construct() {
		parent::__construct('annualReportSelection');
	}
	
	public function init() {
		$this->setHydrator(new ClassMethods(false));
		$this->setObject(new TerritorySelectionObject());
		
		$this->add(array(
			'name' => 'selection',
			'type' => 'checkbox'
		));
		
		$this->add(array(
			'name' => 'territory',
			'type' => 'Application\Form\Fieldset\Territory'
		));
	}
}