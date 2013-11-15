<?php
namespace Report\Generator\Service;

use Zend\ServiceManager\AbstractPluginManager;
use Report\Parameter\StorageInterface;
use Report\Contract\GeneratorInterface;

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