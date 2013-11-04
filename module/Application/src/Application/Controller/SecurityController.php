<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Authentication\AuthenticationService;
use Application\Security\Authentication\Adapter;
use Application\Form\LoginForm;

class SecurityController extends AbstractActionController {
	/**
	 * Handler login
	 */
	public function loginAction() {
		$loginForm = new LoginForm();
		
		$authenticationService = $this->getAuthenticationService();
		
		if($authenticationService->hasIdentity()) {
			$this->redirect()->toRoute('home');
		}
		
		if($this->request->isPost()) {
			$loginForm->setData($this->request->getPost());
			
			if($loginForm->isValid()) {
				/* @var $authenticationAdapter Adapter */
				$authenticationAdapter = $authenticationService->getAdapter();
				$authenticationAdapter->setUsername($loginForm->get('username')->getValue());
				$authenticationAdapter->setPassword($loginForm->get('password')->getValue());
				
				$authenticationResult = $authenticationService->authenticate();
				if($authenticationResult->isValid()) {
					$this->redirect()->toRoute('home');
				}
			}
		}
		
		return array(
			'loginForm' => $loginForm
		);
	}
	
	public function logoutAction() {
		if($this->getAuthenticationService()->hasIdentity()) {
			$this->getAuthenticationService()->clearIdentity();
		}
		$this->redirect()->toRoute('home');
	}
	
	/**
	 * @return AuthenticationService
	 */
	protected function getAuthenticationService() {
		return $this->serviceLocator->get('Zend\Authentication\AuthenticationService');
	}
}