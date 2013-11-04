<?php
namespace Report\Contract;

interface StrategyHolderInterface {
	/**
	 * Tambahin strategy.
	 * 
	 * @param unknown $name
	 * @param StrategyInterface $strategy
	 */
	public function addStrategy($name, StrategyInterface $strategy);
	
	/**
	 * Apakah ada strategy berdasarkan nama.
	 * 
	 * @param string $name
	 * @return bool
	 */
	public function hasStrategy($name);
	
	/**
	 * Retrieve strategy berdasarkan namanya.
	 * 
	 * @param string $name
	 * @return StrategyInterface
	 */
	public function getStrategy($name);
	
	/**
	 * Retrieve seluruh strategy.
	 * 
	 * @return array
	 */
	public function getStrategies();
	
	/**
	 * Remove strategy dari stack strategy.
	 * 
	 * @param string $name
	 */
	public function removeStrategy($name);
	
	/**
	 * Set apakah strategy boleh dioverride atau tidak.
	 * 
	 * @param boolean $allowStrategyOverride
	 */
	public function setAllowStrategyOverride($allowStrategyOverride);
	
	/**
	 * @return boolean
	 */
	public function getAllowStrategyOverride();
}