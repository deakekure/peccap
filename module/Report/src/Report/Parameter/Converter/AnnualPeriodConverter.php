<?php
namespace Report\Parameter\Converter;

use Report\Parameter\ConverterInterface as Converter;
use DoctrineModule\Persistence\ObjectManagerAwareInterface as ObjectManagerAware;
use Doctrine\Common\Persistence\ObjectManager;
use Application\Entity\AnnualPeriod;

/**
 * 
 * @author zakyalvan
 */
class AnnualPeriodConverter implements Converter, ObjectManagerAware {
	/**
	 * @var ObjectManager
	 */
	private $objectManager;
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\ConverterInterface::convertToStorage()
	 */
	public function convertToStorage($object) {
		if($object instanceof AnnualPeriod) {
			return array('year' => $object->getYear(), 'current' => $object->getCurrent());
		}
		
		throw new ConversionException(
			sprintf('Parameter object yang diberikan bukan instance dari kelas %s', 'Application\Entity\AnnualPeriod'),
			100,
			null
		);
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\ConverterInterface::convertToParameter()
	 */
	public function convertToParameter($storageArray) {
		return $this->objectManager->find('Application\Entity\AnnualPeriod', $storageArray['year']);
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