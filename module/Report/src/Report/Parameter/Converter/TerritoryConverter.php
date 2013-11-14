<?php
namespace Report\Parameter\Converter;

use Report\Parameter\ConverterInterface as Converter;
use DoctrineModule\Persistence\ObjectManagerAwareInterface as ObjectManagerAware;
use Doctrine\Common\Persistence\ObjectManager;
use Application\Entity\Territory;

/**
 * 
 * @author zakyalvan
 */
class TerritoryConverter implements Converter, ObjectManagerAware {
	/**
	 * @var ObjectManager
	 */
	private $objectManager;
	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\ConverterInterface::convertToStorage()
	 */
	public function convertToStorage($object) {
		if($object instanceof Territory) {
			return array('id' => $object->getId());
		}
		
		throw new ConversionException(
			sprintf('Parameter object yang diberikan bukan instance dari kelas %s', 'Application\Entity\Territory'),
			100,
			null
		);
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\ConverterInterface::convertToParameter()
	 */
	public function convertToParameter($storageObject) {
		return $this->objectManager->find('Application\Entity\Territory', $storageObject['id']);
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