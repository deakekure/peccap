<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Authentication\AuthenticationService;
use Application\Security\Authentication\Adapter;
use Application\Form\LoginForm;
use Zend\Authentication\Result;

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
		
		$errorMessage = false;
		if($this->request->isPost()) {
			$loginForm->setData($this->request->getPost());
			
			if($loginForm->isValid()) {
				/* @var $authenticationAdapter Adapter */
				$authenticationAdapter = $authenticationService->getAdapter();
				$authenticationAdapter->setUsername($loginForm->get('username')->getValue());
				$authenticationAdapter->setPassword($loginForm->get('password')->getValue());
				
				$authenticationResult = $authenticationService->authenticate();
				if($authenticationResult->isValid()) {
					$this->redirect()->toRoute('report');
				}
				else {
					switch ($authenticationResult->getCode()) {
						case Result::FAILURE_IDENTITY_NOT_FOUND :
							$errorMessage = 'Username yang Anda berikan tidak valid';
							break;
						case Result::FAILURE_CREDENTIAL_INVALID :
							$errorMessage = 'Password yang Anda berikan salah';
							break;
						case Result::FAILURE :
							$errorMessage = 'Login gagal';
							break;
					}
				}
			}
		}
		
		return array(
			'errorMessage' => $errorMessage,
			'loginForm' => $loginForm
		);
	}
	
	public function logoutAction() {
		if($this->getAuthenticationService()->hasIdentity()) {
			$this->getAuthenticationService()->clearIdentity();
		}
		$this->redirect()->toRoute('report');
	}
	
	/**
	 * @return AuthenticationService
	 */
	protected function getAuthenticationService() {
		return $this->serviceLocator->get('Zend\Authentication\AuthenticationService');
	}
}