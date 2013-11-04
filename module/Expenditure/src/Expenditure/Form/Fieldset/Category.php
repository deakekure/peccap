<?php
namespace Expenditure\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Form\FormElementManager;

/**
 * 
 * @author zakyalvan
 *
 */
class Category extends Fieldset implements InputFilterProviderInterface, ServiceLocatorAwareInterface {
	/**
	 * @var ServiceLocatorInterface
	 */
	private $serviceLocator;
	
	public function __construct() {
		parent::__construct('Category');
	}
	
	public function init() {
		$objectManager = $this->serviceLocator->get('Doctrine\ORM\EntityManager');
		$this->setHydrator(new DoctrineObject($objectManager, 'Expenditure\Entity\Category'));
		
		$this->add(array(
			'name' => 'id',
			'type' => 'hidden',
			'options' => array(
			
			),
			'attributes' => array(
				
			)
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