<?php
namespace Report\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Report\Contract\GeneratorInterface;
use Report\Contract\Report;

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
	 * Apakah view helper dapat merender report dengan id yang diberikan.
	 * 
	 * @param string $reportId
	 */
	public function canRender($reportId) {
		return $this->getReportGeneratorManager()
			->getReportGenerator($reportId)
			->canGenerate($this->getReportGeneratorManager()->getParameterStorage()->read());
	}
	
	/**
	 * Render report.
	 * 
	 * @param string $reportId
	 */
	public function render($reportId) {
		if(!$this->canRender($reportId)) {
			throw new \RuntimeException('Tidak dapat merender report', 100, null);
		}
		
		/* @var $reportGenerator GeneratorInterface */
		$reportGenerator = $this->getReportGeneratorManager()->getReportGenerator($reportId);
		$this->doRender($reportGenerator->generate($this->getReportGeneratorManager()->getParameterStorage()->read()));
	}
	
	/**
	 * Lakukan rendering laporan.
	 * 
	 * @param GeneratorInterface $reportGenerator
	 */
	abstract protected function doRender(Report $report);
	
	/**
	 * @return ReportGeneratorManager
	 */
	protected function getReportGeneratorManager() {
		if($this->reportGeneratorManager === null) {
			$this->reportGeneratorManager = $this->serviceLocator->get('ReportGeneratorManager');
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