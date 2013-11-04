<?php
namespace Report\Parameter;

use Zend\ServiceManager\ServiceLocatorAwareInterface as ServiceLocatorAware;
use Zend\ServiceManager\ServiceLocatorInterface as ServiceLocator;

class ParameterConverter implements ConverterInterface, ConverterAggregateInterface, ServiceLocatorAware {
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
		
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\ConverterInterface::convertToParameter()
	 */
	public function convertToParameter($storageObject) {
		
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\ConverterHolderInterface::addConverter()
	 */
	public function addConverter($className, ConverterInterface $converter) {
		$this->childConverters->{$className} = $converter;
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\ConverterHolderInterface::hasConverter()
	 */
	public function hasConverter($className) {
		return isset($this->childConverters->{$className});
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\ConverterHolderInterface::getConverter()
	 */
	public function getConverter($className) {
		return $this->childConverters->{$className};
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\ConverterHolderInterface::removeConverter()
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