<?php
namespace Report\Contract;

/**
 * Kontrak interface untuk report.
 * 
 * @author zakyalvan
 */
interface ReportInterface {
	/**
	 * Retrieve report-data-provider.
	 * 
	 * @return DataProviderInterface
	 */
	public function getDataProvider();
	
	/**
	 * Set report-data-provider. Supplai data-provider ini adalah tanggung jawab dari report generator.
	 * Data provider ini memungkinkan generate data on-demand.
	 * 
	 * @param DataProviderInterface $dataProvider
	 */
	public function setDataProvider(DataProviderInterface $dataProvider);
}