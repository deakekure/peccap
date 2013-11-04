<?php
namespace Income;

use Zend\ModuleManager\Feature\ConfigProviderInterface as ConfigProvider;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface as AutoloaderProvider;

/**
 * @author zakyalvan
 */
class Module implements ConfigProvider, AutoloaderProvider {
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ModuleManager\Feature\ConfigProviderInterface::getConfig()
	 */
	public function getConfig() {
		return include __DIR__ . '/config/module.config.php';
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ModuleManager\Feature\AutoloaderProviderInterface::getAutoloaderConfig()
	 */
	public function getAutoloaderConfig() {
		return array(
			'Zend\Loader\ClassMapAutoloader' => array(
				__DIR__ . '/autoload_classmap.php'
			),
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
				)
			)
		);
	}
}