<?php
namespace Report\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Report\Form\Object\SourceSelection as SourceSelectionObject;

class SourceSelection extends Fieldset {
	public function __construct() {
		parent::__construct('sourceSelection');
	}
	
	public function init() {
		$this->setHydrator(new ClassMethodsHydrator(false));
		$this->setObject(new SourceSelectionObject());
	
		$this->add(array(
			'name' => 'selection',
			'type' => 'checkbox'
		));
	
		$this->add(array(
			'name' => 'source',
			'type' => 'Income\Form\Fieldset\Source',
			'options' => array(),
			'attributes' => array()
		));
	}
}