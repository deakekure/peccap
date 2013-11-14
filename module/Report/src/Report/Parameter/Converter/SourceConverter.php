<?php
namespace Report\Parameter\Converter;

use Report\Parameter\ConverterInterface as Converter;
use DoctrineModule\Persistence\ObjectManagerAwareInterface as ObjectManagerAware;
use Doctrine\Common\Persistence\ObjectManager;
use Income\Entity\Source;

/**
 * 
 * @author zakyalvan
 */
class SourceConverter implements Converter, ObjectManagerAware {
	/**
	 * @var ObjectManager
	 */
	private $objectManager;
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\ConverterInterface::convertToStorage()
	 */
	public function convertToStorage($object) {
		if($object instanceof Source) {
			return array('name' => $object->getName());
		}
		
		throw new ConversionException(
			sprintf('Parameter object yang diberikan bukan instance dari kelas %s', 'Income\Entity\Source'),
			100,
			null
		);
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\ConverterInterface::convertToParameter()
	 */
	public function convertToParameter($storageArray) {
		return $this->objectManager->find('Income\Entity\Source', $storageArray['name']);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \DoctrineModule\Persistence\ObjectManagerAwareInterface::setObjectManager()
	 */
	public function setObjectManager(ObjectManager $objectManager) {
		$this->objectManager = $objectManager;
	}
	/**
	 * (non-PHPdoc)
	 * @see \DoctrineModule\Persistence\ObjectManagerAwareInterface::getObjectManager()
	 */
	public function getObjectManager() {
		return $this->objectManager;
	}
}