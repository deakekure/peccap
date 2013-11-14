<?php
namespace Report\Generator\Service;

use Zend\ServiceManager\ConfigInterface as Config;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceLocatorAwareInterface as ServiceLocatorAware;
use Zend\Stdlib\InitializableInterface as Initializable;
use Report\Contract\GeneratorInterface as Generator;

/**
 * Konfigurasi untuk generator manager.
 * 
 * @author zakyalvan
 */
class GeneratorManagerConfig implements Config {
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\ConfigInterface::configureServiceManager()
	 */
	public function configureServiceManager(ServiceManager $serviceManager) {
// 		$configuration = $serviceManager->get('Config');
		
// 		if(isset($configuration['report_generators'])) {
// 			foreach ($configuration['report_generators'] as $reportGeneratorClass) {
// 				/* @var $reportGenerator GeneratorInterface */
// 				$reportGenerator = new $reportGeneratorClass;
				
// 				if(!$reportGenerator instanceof Generator) {
// 					throw new \RuntimeException('Kelas report generator bukan instance dari GeneratorInterface', 100, null);
// 				}
				
// 				if($reportGenerator instanceof ServiceLocatorAware) {
// 					$reportGenerator->setServiceLocator($serviceManager);
// 				}
				
// 				$serviceManager->setService($reportGenerator->getId(), $reportGenerator);
// 			}
// 		}
	}
}