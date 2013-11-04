<?php
namespace Report\Parameter;

/**
 * Kontrak untuk tempat penyimpanan parameter report.
 * 
 * @author zakyalvan
 */
interface StorageInterface {
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