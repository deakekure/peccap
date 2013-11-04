<?php
namespace Report\Parameter;

/**
 * Kontrak untuk object yang menyimpan object konverter.
 * 
 * @author zakyalvan
 */
interface ConverterAggregateInterface extends ConverterInterface {
	/**
	 * Tambahin konverter untuk kelas yang diberikan.
	 * 
	 * @param string $className
	 * @param ConverterInterface $converter
	 */
	public function addConverter($className, ConverterInterface $converter);
	
	/**
	 * Akakah ada konverter untuk nama kelas yang diberikan.
	 * 
	 * @param string $className
	 * @return boolean
	 */
	public function hasConverter($className);
	
	/**
	 * Retrieve konverter berdasarkan nama kelas yang dikonvert.
	 * 
	 * @param string $className
	 * @return ConverterInterface
	 */
	public function getConverter($className);
	
	/**
	 * Remove konverter untuk nama kelas yang diberikan.
	 * 
	 * @param string $className
	 */
	public function removeConverter($className);
}