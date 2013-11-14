<?php
namespace Application\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Form\FormElementManager;

class AnnualPeriod extends Fieldset implements InputFilterProviderInterface, ServiceLocatorAwareInterface {
	/**
	 * @var ServiceLocatorInterface
	 */
	private $serviceLocator;
	
	public function init() {
		$objectManager = $this->serviceLocator->get('Doctrine\ORM\EntityManager');
		$this->setHydrator(new DoctrineObject($objectManager, 'Application\Entity\AnnualPeriod'));
	
		$this->add(array(
			'name' => 'year',
			'type' => 'text',
			'options' => array(
				'label' => 'Tahun'
			)
		));
	
		$this->add(array(
			'name' => 'current',
			'type' => 'checkbox',
			'options' => array(
				'label' => 'Current'
			)
		));
	}
	
	public function getInputFilterSpecification() {
		return array(
			'year' => array(
				'required' => false,
				'filters' => array()
			),
			'current' => array(
				'required' => false,
				'filters' => array()
			)
		);
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