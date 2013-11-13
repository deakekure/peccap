<?php
namespace Report\Contract;

/**
 * Kontrak untuk provider parameter.
 * 
 * @author zakyalvan
 */
interface ParameterProviderInterface {
	/**
	 * @return Parameter
	 */
	public function getParameter();
}