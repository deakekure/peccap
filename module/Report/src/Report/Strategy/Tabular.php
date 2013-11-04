<?php
namespace Report\Strategy;

use Report\Contract\StrategyInterface;
use Report\Contract\DataProviderInterface;

class Tabular implements StrategyInterface {
	/**
	 * @var DataProviderInterface
	 */
	private $dataProvider;
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\ReportInterface::getDataProvider()
	 */
	public function getDataProvider() {
		return $this->dataProvider;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\ReportInterface::setDataProvider()
	 */
	public function setDataProvider(DataProviderInterface $dataProvider) {
		$this->dataProvider = $dataProvider;
	}
}