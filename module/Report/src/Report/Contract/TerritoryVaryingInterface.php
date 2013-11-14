<?php
namespace Report\Contract;

use Doctrine\Common\Collections\ArrayCollection;
use Application\Entity\Territory;

/**
 * Kontrak untuk report (generator) yang berfariasi berdasarkan wilayah.
 *
 * @author zakyalvan
 */
interface TerritoryVaryingInterface {
	/**
	 * @return Territory
	 */
	public function getCurrentTerritory();
	
	/**
	 * @param Territory $territory
	 */
	public function setCurrentTerritory(Territory $territory);
	
	/**
	 * @return ArrayCollection
	 */
	public function getTerritorySelections();
}