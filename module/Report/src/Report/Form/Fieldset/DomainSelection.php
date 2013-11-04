<?php
namespace Report\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Report\Form\Object\DomainSelection as DomainSelectionObject;

class DomainSelection extends Fieldset implements InputFilterProviderInterface {
	public function __construct() {
		parent::__construct('domainSelection');
	}
	
	public function init() {
		$this->setHydrator(new ClassMethodsHydrator(false));
		$this->setObject(new DomainSelectionObject());
		
		$this->add(array(
			'name' => 'selection',
			'type' => 'checkbox'
		));
		
		$this->add(array(
			'name' => 'domain',
			'type' => 'Expenditure\Form\Fieldset\Domain'
		));
	}
	
	public function getInputFilterSpecification() {
		return array();
	}
}