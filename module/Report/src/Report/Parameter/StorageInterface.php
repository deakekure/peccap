<?php
namespace Report\Parameter;

use Report\Contract\Parameter;
/**
 * Kontrak untuk tempat penyimpanan parameter report.
 * 
 * @author zakyalvan
 */
interface StorageInterface {
	/**
	 * Retrieve default parameter.
	 * 
	 * @return Parameter
	 */
	public function getDefault();
	
	/**
	 * Apakah storage ini empty.
	 */
	public function isEmpty();
	
	/**
	 * Simpan report parameter.
	 * 
	 * @param Parameter $parameter
	 */
	public function write(Parameter $parameter);
	
	/**
	 * @return Parameter
	 */
	public function read();
	
	/**
	 * Reset report parameter storage.
	 */
	public function reset();
}