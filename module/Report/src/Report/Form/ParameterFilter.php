<?php
namespace Report\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class ParameterFilter extends Form {
	public function init() {
		$this->setAttribute('method', 'post');
		$this->setHydrator(new ClassMethods(false));
		
		$this->add(array(
			'name' => 'parameter',
			'type' => 'ParameterFieldset',
			'options' => array(
				'use_as_base_fieldset' => true
			)
		));
		
		$this->add(array(
			'name' => 'submit',
			'type' => 'submit',
			'attributes' => array(
				'value' => 'Lihat'
			)
		));
	}
}