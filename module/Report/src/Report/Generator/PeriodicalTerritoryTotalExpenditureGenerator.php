<?php
namespace Report\Generator;

use Zend\Stdlib\InitializableInterface as Initializable;
use Doctrine\ORM\EntityManager;
use Report\Contract\AbstractGenerator;
use Report\Contract\Parameter;

/**
 * Kelas yang menggenerate data laporan total pengeluran tahunan masing-masing daerah.
 * 
 * @author zakyalvan
 */
class PeriodicalTerritoryTotalExpenditureGenerator extends AbstractGenerator implements Initializable {
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Stdlib\InitializableInterface::init()
	 */
	public function init() {
		$this->dataClass = 'Report\Generator\Data\PeriodicalTerritoryTotalExpenditure';
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\AbstractGenerator::checkCanGenerate()
	 */
	protected function checkCanGenerate(Parameter $parameter) {
		
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\AbstractGenerator::buildDataQuery()
	 */
	protected function buildDataQuery(Parameter $parameter, EntityManager $entityManager) {
		$queryBuilder = $entityManager->createQueryBuilder();
		
		return $queryBuilder;
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\AbstractGenerator::createDataObject()
	 */
	protected function createDataObject($object) {
		return $object;
	}
}