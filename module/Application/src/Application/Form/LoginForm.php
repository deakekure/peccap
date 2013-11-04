<?php
namespace Application\Form;

use Zend\Form\Form;

/**
 * Login form.
 * 
 * @author zakyalvan
 */
class LoginForm extends Form {
	public function __construct() {
		parent::__construct('LoginForm');
		
		$this->add(array(
			'name' => 'username',
			'type' => 'text',
			'options' => array(
			
			),
			'attributes' => array(
				'class' => 'form-control',
				'style' => 'width: 150px;',
				'placeholders' => 'Username'
			)
		));
		
		$this->add(array(
			'name' => 'password',
			'type' => 'password',
			'options' => array(
							
			),
			'attributes' => array(
				'class' => 'form-control',
				'style' => 'width: 150px;',
				'placeholders' => 'Password'
			)
		));
	}
}