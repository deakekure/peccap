<?php
namespace Report\Contract;

/**
 * Kontrak untuk kelas yang menyediakan data untuk report.
 * Interface ini untuk memungkinkan generate data report on demand.
 * 
 * @author zakyalvan
 */
interface DataProviderInterface {
	/**
	 * Retrieve type atau kelas dari data object yang disediakan oleh provider.
	 * 
	 * @return string
	 */
	public function getDataClass();
	
	/**
	 * Retrieve data.
	 * 
	 * @throws DataProviderException
	 * @return DataInterface
	 */
	public function getData();
}