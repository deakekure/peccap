<?php
namespace Application\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Form\FormElementManager;

class Territory extends Fieldset implements InputFilterProviderInterface, ServiceLocatorAwareInterface {
	/**
	 * @var ServiceLocatorInterface
	 */
	private $serviceLocator;
	
	public function init() {
		$objectManager = $this->serviceLocator->get('Doctrine\ORM\EntityManager');
		$this->setHydrator(new DoctrineObject($objectManager, 'Application\Entity\Territory'));
		
		$this->add(array(
			'name' => 'id',
			'type' => 'text',
			'options' => array(
				'label' => 'Kode Wilayah'
			)
		));
		
		$this->add(array(
			'name' => 'name',
			'type' => 'text',
			'options' => array(
				'label' => 'Nama'
			)
		));
	}
	
	public function getInputFilterSpecification() {
		return array();
	}
	
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
		if($serviceLocator instanceof FormElementManager) {
			$this->serviceLocator = $serviceLocator->getServiceLocator();
		}
		else {
			$this->serviceLocator = $serviceLocator;
		}
	}
	
	public function getServiceLocator() {
		return $this->serviceLocator;
	}
	
}