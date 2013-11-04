<?php
namespace Report\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Http\Request;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

/**
 * Form filter untuk lihat report expenditure atau pengeluaran.
 * 
 * @author zakyalvan
 */
class ParameterFieldset extends Fieldset implements InputFilterProviderInterface, ServiceLocatorAwareInterface {
	/**
	 * @var ServiceLocatorInterface
	 */
	private $serviceLocator;
	
	public function __construct() {
		parent::__construct('parameterFieldset');
		
	}
	
	public function init() {
		$this->setHydrator(new ClassMethodsHydrator(false));
		
		$this->add(array(
			'name' => 'territorySelections',
			'type' => 'Zend\Form\Element\Collection',
			'options' => array(
				'allow_add' => true,
				'count' => 0,
				'target_element' => array(
					'type' => 'Report\Form\Fieldset\TerritorySelection'
				)
			)
		));
		
		$this->add(array(
			'name' => 'categorySelections',
			'type' => 'Zend\Form\Element\Collection',
			'options' => array(
				'allow_add' => true,
				'count' => 0,
				'target_element' => array(
					'type' => 'Report\Form\Fieldset\CategorySelection'
				)
			)
		));
		
		$this->add(array(
			'name' => 'domainSelections',
			'type' => 'Zend\Form\Element\Collection',
			'options' => array(
				'allow_add' => true,
				'count' => 0,
				'target_element' => array(
					'type' => 'Report\Form\Fieldset\DomainSelection'
				)
			)
		));

		$this->add(array(
			'name' => 'annualPeriodSelections',
			'type' => 'Zend\Form\Element\Collection',
			'options' => array(
				'allow_add' => true,
				'count' => 0,
				'target_element' => array(
					'type' => 'Report\Form\Fieldset\AnnualPeriodSelection'
				)
			)
		));
		
		$this->add(array(
			'name' => 'sourceSelections',
			'type' => 'Zend\Form\Element\Collection',
			'options' => array(
				'allow_add' => true,
				'count' => 0,
				'target_element' => array(
					'type' => 'Report\Form\Fieldset\SourceSelection'
				)
			)
		));
	}
	
	public function getInputFilterSpecification() {
		return array();
	}
	
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
		$this->serviceLocator = $serviceLocator;
	}
	
	public function getServiceLocator() {
		return $this->serviceLocator;
	}
}