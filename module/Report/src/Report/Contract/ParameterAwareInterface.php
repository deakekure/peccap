<?php
namespace Report\Contract;

/**
 * Kontrak untuk parameter-aware-object (Object yang membutuhkan parameter).
 * 
 * @author zakyalvan
 */
interface ParameterAwareInterface {
	/**
	 * Retrieve parameter.
	 * 
	 * @return Parameter
	 */
	public function getParameter();
	
	/**
	 * Set parameter.
	 * 
	 * @param Parameter $parameter
	 */
	public function setParameter(Parameter $parameter);
}