<?php
namespace Report\Generator\Service;

use Zend\ServiceManager\AbstractPluginManager;
use Report\Parameter\StorageInterface;
use Report\Contract\GeneratorInterface;
use Report\Contract\Parameter;

/**
 * Ini kontrak untuk kelas report manager.
 * 
 * @author zakyalvan
 */
interface GeneratorManagerInterface {
	/**
	 * Retrieve default parameter.
	 * 
	 * @return Parameter
	 */
	public function getDefaultParameter();
	
	/**
	 * @return StorageInterface
	 */
	public function getParameterStorage();
	
	/**
	 * @return GeneratorInterface
	 */
	public function getReportGenerator($id);
}