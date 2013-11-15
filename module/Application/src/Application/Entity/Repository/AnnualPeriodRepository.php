<?php
namespace Application\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Application\Entity\AnnualPeriod;

/**
 * Custom repository annual-period.
 * 
 * @author zakyalvan
 */
class AnnualPeriodRepository extends EntityRepository {
	/**
	 * @return AnnualPeriod
	 */
	public function getCurrentPeriod() {
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		return $queryBuilder->select('period')
			->from($this->getClassName(), 'period')
			->where($queryBuilder->expr()->neq('period.current', ':notCurrentFlag'))
			->setParameter('notCurrentFlag', 0)
			->getQuery()
			->getSingleResult();
	}
	
	/**
	 * Ambil lima periode tahunan terakhir.
	 */
	public function getLastPeriods($number = 5) {
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		return $queryBuilder->select('period')
			->from($this->getClassName(), 'period')
			->orderBy('period.year', 'DESC')
			->getQuery()
			->setFirstResult(0)
			->setMaxResults($number)
			->getResult();
	}
}