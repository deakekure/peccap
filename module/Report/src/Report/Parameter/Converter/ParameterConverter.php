<?php
namespace Report\Parameter\Converter;

use Zend\ServiceManager\ServiceLocatorAwareInterface as ServiceLocatorAware;
use Zend\ServiceManager\ServiceLocatorInterface as ServiceLocator;
use Report\Contract\Parameter;
use Report\Parameter\ConverterAggregateInterface as ConverterAggregate;
use Report\Parameter\Exception\ConversionException;

class ParameterConverter implements ConverterInterface, ConverterAggregate, ServiceLocatorAware {
	/**
	 * @var \ArrayObject
	 */
	private $childConverters;
	
	/**
	 * @var ServiceLocator
	 */
	private $serviceLocator;
	
	public function __construct() {
		$this->childConverters = new \ArrayObject(array());
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\ConverterInterface::convertToStorage()
	 */
	public function convertToStorage($object) {
		if($object instanceof Parameter) {
			$storageArray = array();
			
			$storageArray['annualPeriods'] = array();
			foreach ($object->getAnnualPeriods() as $index => $annualPeriod) {
				$storageArray['annualPeriods'][$index] = $this->getConverter(get_class($annualPeriod))->convertToStorage($annualPeriod);
			}
			
			$storageArray['territories'] = array();
			foreach ($object->getTerritories() as $index => $territory) {
				$storageArray['territories'][$index] = $this->getConverter(get_class($territory))->convertToStorage($territory);
			}
			
			$storageArray['domains'] = array();
			foreach ($object->getDomains() as $index => $domain) {
				$storageArray['domains'][$index] = $this->getConverter(get_class($domain))->convertToStorage($domain);
			}
			
			$storageArray['categories'] = array();
			foreach ($object->getCategories() as $index => $category) {
				$storageArray['categories'][$index] = $this->getConverter(get_class($category))->convertToStorage($category);
			}
			
			$storageArray['sources'] = array();
			foreach ($object->getSources() as $index => $source) {
				$storageArray['sources'][$index] = $this->getConverter(get_class($source))->convertToStorage($source);
			}
			
			return $storageArray;
		}
		
		throw new ConversionException(
			sprintf('Parameter object yang diberikan bukan instance dari kelas %s', 'Report\Contract\Parameter'), 
			100, 
			null
		);
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\ConverterInterface::convertToParameter()
	 */
	public function convertToParameter($storageArray) {
		if(is_array($storageArray)) {
			$parameter = new Parameter();
			
			foreach ($storageArray['annualPeriods'] as $annualPeriodArray) {
				$annualPeriod = $this->getConverter('Application\Entity\AnnualPeriod')->convertToParameter($annualPeriodArray);
				$parameter->getAnnualPeriods()->add($annualPeriod);
			}
			
			foreach ($storageArray['territories'] as $territoryArray) {
				$territory = $this->getConverter('Application\Entity\Territory')->convertToParameter($territoryArray);
				$parameter->getTerritories()->add($territory);
			}
			
			foreach ($storageArray['domains'] as $domainArray) {
				$domain = $this->getConverter('Expenditure\Entity\Domain')->convertToParameter($domainArray);
				$parameter->getDomains()->add($domain);
			}
			
			foreach ($storageArray['categories'] as $categoryArray) {
				$category = $this->getConverter('Expenditure\Entity\Category')->convertToParameter($categoryArray);
				$parameter->getCategories()->add($category);
			}
			
			foreach ($storageArray['sources'] as $sourceArray) {
				$source = $this->getConverter('Income\Entity\Source')->convertToParameter($sourceArray);
				$parameter->getSources()->add($source);
			}
			
			return $parameter;
		}
		
		throw new ConversionException(
			sprintf('Parameter object yang diberikan bukan instance dari kelas %s. %s diberikan.', 'Report\Contract\Parameter', var_dump($storageArray)),
			100,
			null
		);
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\ConverterAggregateInterface::addConverter()
	 */
	public function addConverter($className, ConverterInterface $converter) {
		$this->childConverters->{$className} = $converter;
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\ConverterAggregateInterface::hasConverter()
	 */
	public function hasConverter($className) {
		return isset($this->childConverters->{$className});
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\ConverterAggregateInterface::getConverter()
	 */
	public function getConverter($className) {
		if(!$this->hasConverter($className)) {
			throw new ConversionException(sprintf('Converter untuk object kelas %s tidak ditemukan dalam stack converter', $className), 100, null);
		}
		return $this->childConverters->{$className};
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\ConverterAggregateInterface::removeConverter()
	 */
	public function removeConverter($className) {
		unset($this->childConverters->{$className});
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
	 */
	public function setServiceLocator(ServiceLocator $serviceLocator) {
		$this->serviceLocator = $serviceLocator;
	}
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
	 */
	public function getServiceLocator() {
		return $this->serviceLocator;
	}
}