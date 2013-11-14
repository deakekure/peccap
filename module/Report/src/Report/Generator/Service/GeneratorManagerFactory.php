<?php
namespace Report\Generator\Service;

use Zend\ServiceManager\FactoryInterface as Factory;
use Zend\ServiceManager\ServiceLocatorInterface as ServiceLocator;
use Zend\Stdlib\InitializableInterface as Initializable;

/**
 * Kelas factory untuk generator manager.
 * 
 * @author zakyalvan
 */
class GeneratorManagerFactory implements Factory {
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 */
	public function createService(ServiceLocator $serviceLocator) {
		$generatorManagerConfig = new GeneratorManagerConfig();
		
		$generatorManager = new GeneratorManager($generatorManagerConfig);
		$generatorManager->setServiceLocator($serviceLocator);
		$generatorManager->addPeeringServiceManager($serviceLocator);
		$generatorManager->setRetrieveFromPeeringManagerFirst(true);
		
		if($generatorManager instanceof Initializable) {
			$generatorManager->init();
		}
		
		$configuration = $serviceLocator->get('Config');
		if (isset($configuration['di']) && $serviceLocator->has('Di')) {
			$generatorManager->addAbstractFactory($serviceLocator->get('DiAbstractServiceFactory'));
		}
		
		return $generatorManager;
	}
}