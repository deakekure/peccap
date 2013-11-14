<?php
namespace Report\Form;

use Zend\Form\Form;
use Zend\Form\FormInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodHydrator;
use Zend\Form\Element\Collection;
use Report\Contract\ParameterAwareInterface;
use Report\Form\Fieldset\ParameterFieldset;
use Report\Contract\Parameter;
use Report\Form\Object\ParameterFilter as ParameterFilterObject;
use Report\Form\Object\TerritorySelection;
use Report\Form\Object\AnnualPeriodSelection;
use Report\Form\Object\DomainSelection;
use Report\Form\Object\CategorySelection;
use Report\Form\Object\SourceSelection;
use Application\Entity\AnnualPeriod;
use Application\Entity\Territory;
use Expenditure\Entity\Domain;
use Expenditure\Entity\Category;
use Income\Entity\Source;

/**
 * Form untuk ngefilter parameter.
 * 
 * @author zakyalvan
 */
class ParameterFilter extends Form implements ParameterAwareInterface {
	/**
	 * 
	 * @var Parameter
	 */
	private $parameter;
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Form\Element::init()
	 */
	public function init() {
		$this->setAttribute('method', 'post');
		$this->setHydrator(new ClassMethodHydrator(false));
		
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
				'value' => 'Lihat',
				'class' => 'btn btn-info'
			)
		));
		$this->add(array(
			'name' => 'reset',
			'type' => 'submit',
			'attributes' => array(
				'value' => 'Reset',
				'class' => 'btn btn-default'
			)
		));
	}
	
	/**
	 * Sinkronisasi object dengan parameter.
	 */
	private function synchObjectWithParameter() {
		if($this->object !== null && $this->parameter !== null) {
			/* @var $formObject ParameterFilterObject */
			$formObject = $this->object;
			
			/* @var $annualPeriodSelections Collection */
			$annualPeriodSelections = $this->get('parameter')->get('annualPeriodSelections');
			/* @var $annualPeriod AnnualPeriod */
			foreach ($this->parameter->getAnnualPeriods() as $annualPeriod) {
				/* @var $annualPeriodSelection AnnualPeriodSelection */
				foreach ($annualPeriodSelections->getObject() as $annualPeriodSelection) {
					if($annualPeriod->getYear() === $annualPeriodSelection->getAnnualPeriod()->getYear()) {
						$annualPeriodSelection->setSelection(1);
						continue;
					}					
				}
			}
			
			/* @var $territorySelections Collection */
			$territorySelections = $this->get('parameter')->get('territorySelections');
			/* @var $territory Territory */
			foreach ($this->parameter->getTerritories() as $territory) {
				/* @var $territorySelection TerritorySelection */
				foreach ($territorySelections->getObject() as $territorySelection) {
					if($territory->getId() === $territorySelection->getTerritory()->getId()) {
						$territorySelection->setSelection(1);
						continue;
					}
				}
			}
			
			/* @var $domainSelections Collection */
			$domainSelections = $this->get('parameter')->get('domainSelections');
			/* @var $domain Domain */
			foreach ($this->parameter->getDomains() as $domain) {
				/* @var $domainSelection DomainSelection */
				foreach ($domainSelections->getObject() as $domainSelection) {
					if($domain->getId() === $domainSelection->getDomain()->getId()) {
						$domainSelection->setSelection(1);
						continue;
					}
				}
			}
			
			/* @var $categorySelections Collection */
			$categorySelections = $this->get('parameter')->get('categorySelections');
			/* @var $category Category */
			foreach ($this->parameter->getCategories() as $category) {
				/* @var $categorySelection CategorySelection */
				foreach ($categorySelections->getObject() as $categorySelection) {
					if($category->getId() === $categorySelection->getCategory()->getId()) {
						$categorySelection->setSelection(1);
						continue;
					}
				}
			}
			
			/* @var $sourceSelections Collection */
			$sourceSelections = $this->get('parameter')->get('sourceSelections');
			/* @var $source Source */
			foreach ($this->parameter->getSources() as $source) {
				/* @var $sourceSelection SourceSelection */
				foreach ($sourceSelections->getObject() as $sourceSelection) {
					if($source->getName() === $sourceSelection->getSource()->getName()) {
						$sourceSelection->setSelection(1);
						continue;
					}
				}
			}
			
			// Extract ulang object ke element.
			$this->extract();
		}
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Form\Form::bind()
	 */
	public function bind($object, $flags = FormInterface::VALUES_NORMALIZED) {
		parent::bind($object, $flags);
		$this->synchObjectWithParameter();
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\ParameterAwareInterface::getParameter()
	 */
	public function getParameter() {
		$parameter = new Parameter();
			
		/* @var $territorySelections Collection */
		$territorySelections = $this->get('parameter')->get('territorySelections');
		/* @var $territorySelectionObject TerritorySelection */ 
		foreach ($territorySelections->getObject() as $territorySelectionObject) {
			if($territorySelectionObject->getSelection()) {
				$parameter->getTerritories()->add($territorySelectionObject->getTerritory());
			}
		}
			
		/* @var $annualPeriodSelections Collection */
		$annualPeriodSelections = $this->get('parameter')->get('annualPeriodSelections');
		/* @var $annualPeriodSelectionObject AnnualPeriodSelection */ 
		foreach ($annualPeriodSelections->getObject() as $annualPeriodSelectionObject) {
			if($annualPeriodSelectionObject->getSelection()) {
				$parameter->getAnnualPeriods()->add($annualPeriodSelectionObject->getAnnualPeriod());
			}
		}
			
		/* @var $domainSelections Collection */
		$domainSelections = $this->get('parameter')->get('domainSelections');
		/* @var $domainSelectionObject DomainSelection */ 
		foreach ($domainSelections->getObject() as $domainSelectionObject) {
			if($domainSelectionObject->getSelection()) {
				$parameter->getDomains()->add($domainSelectionObject->getDomain());
			}
		}
			
		/* @var $categorySelections Collection */
		$categorySelections = $this->get('parameter')->get('categorySelections');
		/* @var $categorySelectionObject CategorySelection */ 
		foreach ($categorySelections->getObject() as $categorySelectionObject) {
			if($categorySelectionObject->getSelection()) {
				$parameter->getCategories()->add($categorySelectionObject->getCategory());
			}
		}
			
		/* @var $sourceSelections Collection */
		$sourceSelections = $this->get('parameter')->get('sourceSelections');
		/* @var $sourceSelectionObject SourceSelection */
		foreach ($sourceSelections->getObject() as $sourceSelectionObject) {
			if($sourceSelectionObject->getSelection()) {
				$parameter->getSources()->add($sourceSelectionObject->getSource());
			}
		}
			
		$this->parameter = $parameter;
		
		return $this->parameter;
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\ParameterAwareInterface::setParameter()
	 */
	public function setParameter(Parameter $parameter) {
		$this->parameter = $parameter;
		$this->synchObjectWithParameter();
	}
}