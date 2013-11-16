<?php
namespace Application\Form;

use Zend\Form\Form;
use Zend\Http\Request;

/**
 * Login form.
 * 
 * @author zakyalvan
 */
class LoginForm extends Form {
	public function __construct() {
		parent::__construct('LoginForm');
		
		$this->setAttribute('method', Request::METHOD_POST);
		$this->setAttribute('class', 'form-horizontal');
		$this->setAttribute('role', 'form');
		
		$this->add(array(
			'name' => 'username',
			'type' => 'text',
			'options' => array(
				'label' => 'Username'
			),
			'attributes' => array(
				'class' => 'form-control',
				'placeholders' => 'Username'
			)
		));
		
		$this->add(array(
			'name' => 'password',
			'type' => 'password',
			'options' => array(
				'label' => 'Password'
			),
			'attributes' => array(
				'class' => 'form-control',
				'placeholders' => 'Password'
			)
		));
		
		$this->add(array(
			'name' => 'rememberme',
			'type' => 'checkbox',
			'options' => array(
				''
			)
		));
		
		$this->add(array(
			'name' => 'security',
			'type' => 'csrf'
		));
		
		$this->add(array(
			'name' => 'submit',
			'type' => 'submit',
			'options' => array(
				'label' => 'Login'
			),
			'attributes' => array(
				'value' => 'Login',
				'class' => 'btn btn-info'
			)
		));
		$this->add(array(
			'name' => 'reset',
			'type' => 'button',
			'options' => array(
				'label' => 'Reset'
			),
			'attributes' => array(
				'type' => 'reset',
				'class' => 'btn btn-default'
			)
		));
	}
}