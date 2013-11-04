<?php
namespace Report\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Report\Form\Object\CategorySelection as CategorySelectionObject;

class CategorySelection extends Fieldset {
	public function __construct() {
		parent::__construct('categorySelection');
	}
	
	public function init() {
		$this->setHydrator(new ClassMethodsHydrator(false));
		$this->setObject(new CategorySelectionObject());
		
		$this->add(array(
			'name' => 'selection',
			'type' => 'checkbox'
		));
		
		$this->add(array(
			'name' => 'category',
			'type' => 'Expenditure\Form\Fieldset\Category',
			'options' => array(),
			'attributes' => array()
		));
	}
}