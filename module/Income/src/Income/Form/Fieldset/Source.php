<?php
namespace Income\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\ServiceManager\ServiceLocatorAwareInterface as ServiceLocatorAware;
use Zend\ServiceManager\ServiceLocatorInterface as ServiceLocator;
use Zend\Form\FormElementManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

class Source extends Fieldset implements ServiceLocatorAware {
	/**
	 * @var ServiceLocator
	 */
	private $serviceLocator;
	
	public function __construct() {
		parent::__construct('Source');
	}
	
	public function init() {
		$objectManager = $this->serviceLocator->get('Doctrine\ORM\EntityManager');
		$this->setHydrator(new DoctrineObject($objectManager, 'Expenditure\Entity\Category'));
	
		$this->add(array(
			'name' => 'name',
			'type' => 'hidden',
			'options' => array(
							
			),
			'attributes' => array()
		));
	
		$this->add(array(
			'name' => 'description',
			'type' => 'text',
			'options' => array(
				'label' => 'Deskripsi'
			),
			'attributes' => array(
	
			)
		));
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
	 */
	public function setServiceLocator(ServiceLocator $serviceLocator) {
		if($serviceLocator instanceof FormElementManager) {
			$this->serviceLocator = $serviceLocator->getServiceLocator();
		}
		else {
			$this->serviceLocator = $serviceLocator;
		}
	}
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
	 */
	public function getServiceLocator() {
		return $this->serviceLocator;
	}
}