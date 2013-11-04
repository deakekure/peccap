<?php
namespace Report\Generator\Service;

use Report\Parameter\StorageInterface;
use Report\Generator\GeneratorInterface;
use Zend\ServiceManager\AbstractPluginManager;

/**
 * Ini kontrak untuk kelas report manager.
 * 
 * @author zakyalvan
 */
interface GeneratorManagerInterface {
	/**
	 * @return StorageInterface
	 */
	public function getParameterStorage();
	
	/**
	 * @return GeneratorInterface
	 */
	public function getReportGenerator($id);
}