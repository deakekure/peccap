<?php
namespace Report\Parameter;

use Zend\Session\Container as SessionContainer;

/**
 * Implementasi default parameter storage.
 * 
 * @author zakyalvan
 */
class Storage implements StorageInterface {
	/**
	 * @var Container
	 */
	private $sessionContainer;
	
	/**
	 * @var string
	 */
	private $storageNamespace = 'REPORT_PARAMETER_NAMESPACE';
	
	/**
	 * @var string
	 */
	private $storageKey = 'REPORT_PARAMETER_STORAGE_KEY';
	
	/**
	 * @var Parameter
	 */
	private $cachedParameter;
	
	/**
	 * @var ConverterInterface
	 */
	private $converter;
	
	public function __construct(ConverterInterface $converter) {
		$this->sessionContainer = new SessionContainer($this->storageNamespace);
		$this->converter = $converter;
	}

	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\StorageInterface::isEmpty()
	 */
	public function isEmpty() {
		return isset($this->sessionContainer->{$this->storageKey});
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\StorageInterface::write()
	 */
	public function write(Parameter $parameter) {
		$this->sessionContainer->{$this->storageKey} = $this->converter->convertToStorage($parameter);
		$this->cachedParameter = $parameter;
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\StorageInterface::read()
	 */
	public function read() {
		if($this->cachedParameter !== null) {
			return $this->cachedParameter;
		}
		
		if(!$this->isEmpty()) {
			$parameter = $this->converter->convertToParameter($this->sessionContainer->{$this->storageKey});
			$this->cachedParameter = $parameter;
			return $parameter;
		}
		return null;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\StorageInterface::reset()
	 */
	public function reset() {
		unset($this->sessionContainer->{$this->storageKey});
		$this->cachedParameter = null;
	}
}