<?php
namespace Report\Contract;

use Report\Contract\Exception\GeneratorException;

/**
 * Kontrak dasar untuk report generator.
 * 
 * @author zakyalvan
 */
interface GeneratorInterface {
	/**
	 * Retrieve id dari generator.
	 * 
	 * @return string
	 */
	public function getId();
	
	/**
	 * Apakah report generator dapat meng-generate report berdasarkan parameter yang diberikan.
	 * 
	 * @param Parameter $parameter
	 * @return boolean
	 */
	public function canGenerate(Parameter $parameter);
	
	/**
	 * Generate report.
	 * 
	 * @param Parameter $parameter
	 * @throws GeneratorException
	 * @return Report
	 */
	public function generate(Parameter $parameter);
}