<?php
namespace Report\Generator;

use Zend\Stdlib\InitializableInterface as Initializable;
use Doctrine\ORM\EntityManager;
use Report\Contract\AbstractGenerator;
use Report\Contract\Parameter;
use Report\Strategy\Chart as ChartStrategy;
use Report\Strategy\Tabular as TabularStrategy;
use Report\Contract\CallbackDataSerializer;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Kelas yang menggenerate data laporan total penerimaan tahunan masing-masing daerah.
 * 
 * @author zakyalvan
 */
class PeriodicalTerritoryTotalIncomeGenerator extends AbstractGenerator implements Initializable {
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Stdlib\InitializableInterface::init()
	 */
	public function init() {
		$this->dataClass = 'Report\Generator\Data\PeriodicalTerritoryTotalIncome';
		$chartStrategy = new ChartStrategy();
		$chartStrategy->setDataSerializer(new CallbackDataSerializer(function(ArrayCollection $datas) {
			
		}));
		$this->strategies['chart'] = $chartStrategy;
		
		$tabularStrategy = new TabularStrategy();
		$tabularStrategy->setDataSerializer(new CallbackDataSerializer(function(ArrayCollection $datas) {
			
		}));
		$this->strategies['tabular'] = $tabularStrategy;
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\AbstractGenerator::checkCanGenerate()
	 */
	protected function checkCanGenerate(Parameter $parameter) {
		return true;
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