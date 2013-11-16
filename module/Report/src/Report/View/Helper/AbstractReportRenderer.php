<?php
namespace Report\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Report\Contract\GeneratorInterface;
use Report\Contract\Report;
use Report\Generator\Service\GeneratorManagerInterface;
use Zend\ServiceManager\AbstractPluginManager;
use Report\Contract\Parameter;

/**
 * Kontrak untuk report view helper.
 * 
 * @author zakyalvan
 */
abstract class AbstractReportRenderer extends AbstractHelper implements ServiceLocatorAwareInterface {
	/**
	 * Gunakan mode asinkron (data dan chart tidak dirender bersamaan) secara default.
	 * 
	 * @var boolean
	 */
	protected static $useAsynchronousMode;
	public static function setUseAsynchronousMode($useAsynchronousMode) {
		self::$useAsynchronousMode = $useAsynchronousMode;
	}
	
	/**
	 * @var ServiceLocatorInterface
	 */
	private $serviceLocator;
	
	/**
	 * Private biar child class hanya akses dari getter method.
	 * 
	 * @var GeneratorManagerInterface
	 */
	private $reportGeneratorManager;
	
	/**
	 * Apakah view helper dapat merender report dengan id yang diberikan.
	 * 
	 * @param string $reportId
	 */
	public function canRender($reportId, $useDefaultParameter = false) {
		$parameter = null;
		if($useDefaultParameter) {
			$parameter = $this->getReportGeneratorManager()->getDefaultParameter();
		}
		else {
			$parameter = $this->getReportGeneratorManager()->getParameterStorage()->read();
		}
		
		return $this->getReportGeneratorManager()
			->getReportGenerator($reportId)
			->canGenerate($parameter);
	}
	
	/**
	 * Render report.
	 * 
	 * @param string $reportId
	 */
	public function render($reportId, $useDefaultParameter = false) {
		if(!$this->canRender($reportId, $useDefaultParameter)) {
			throw new \RuntimeException('Tidak dapat merender report', 100, null);
		}
		
		$parameter = null;
		if($useDefaultParameter) {
			$parameter = $this->getReportGeneratorManager()->getDefaultParameter();
		}
		else {
			$parameter = $this->getReportGeneratorManager()->getParameterStorage()->read();
		}
		
		/* @var $reportGenerator GeneratorInterface */
		$reportGenerator = $this->getReportGeneratorManager()->getReportGenerator($reportId);
		return $this->doRender($reportGenerator, $parameter, $useDefaultParameter);
	}
	
	/**
	 * Lakukan rendering laporan.
	 * 
	 * @param GeneratorInterface $reportGenerator
	 */
	abstract protected function doRender(GeneratorInterface $reportGenerator, Parameter $parameter, $isDefaultParameter);
	
	/**
	 * Retrieve report generator manager.
	 * 
	 * @return GeneratorManagerInterface
	 */
	protected function getReportGeneratorManager() {
		$serviceLocator = $this->serviceLocator;
		if($serviceLocator instanceof AbstractPluginManager) {
			$serviceLocator = $serviceLocator->getServiceLocator();
		}
		
		if($this->reportGeneratorManager === null) {
			$this->reportGeneratorManager = $serviceLocator->get('ReportGeneratorManager');
		}
		return $this->reportGeneratorManager;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
	 */
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
		$this->serviceLocator = $serviceLocator;
	}
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
	 */
	public function getServiceLocator() {
		return $this->serviceLocator;
	}
}