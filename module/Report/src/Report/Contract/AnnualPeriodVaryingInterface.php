<?php
namespace Report\Contract;

use Application\Entity\AnnualPeriod;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Kontrak untuk report (generator) yang berfariasi berdasarkan periode waktu.
 * 
 * @author zakyalvan
 */
interface AnnualPeriodVaryingInterface {
	/**
	 * @return AnnualPeriod
	 */
	public function getCurrentAnnualPeriod();
	
	/**
	 * Set periode 
	 * 
	 * @param AnnualPeriod $period
	 */
	public function setCurrentAnnualPeriod(AnnualPeriod $period);
	
	/**
	 * Retrieve period selection.
	 * 
	 * @return ArrayCollection
	 */
	public function getPeriodSelections();
}