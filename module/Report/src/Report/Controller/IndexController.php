<?php
namespace Report\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\EntityManager;
use Report\Form\ParameterFilter;
use Report\Form\Object\ParameterFilter as ParameterFilterObject;
use Report\Generator\Service\GeneratorManagerInterface;

/**
 * Controller utama dari modul reporting.
 * 
 * @author zakyalvan
 */
class IndexController extends AbstractActionController {
	/**
	 * Tampilin default report. Dalam halaman default ini disediakan pilihan untuk tampilin list template
	 * dan tampilin filter untuk pencetakan report.
	 * 
	 * @return array
	 */
	public function indexAction() {
		return array();
	}
	
	/**
	 * Handle request tampilin list template serta pemilihan template oleh user.
	 * Setelah template dipilih, parameter pencetakan report ditentukan berdasarkan template.
	 */
	public function templateAction() {
		$templateId = $this->params()->fromRoute('template', false);
		if($templateId) {
			$this->redirect()->toRoute('');
		}
		else {
			
		}
	}
	
	/**
	 * Tampilin filter pencetakan report.
	 * 
	 * @return array
	 */
	public function filterAction() {
		$report = $this->getReportGeneratorManager()->getReportGenerator('2')->generate($this->getReportGeneratorManager()->getParameterStorage()->read());
		$report->getStrategy('chart')->serialize();
	
		/* @var $filterForm ParameterFilter */
		$filterForm = $this->serviceLocator->get('FormElementManager')->get('ParameterFilter');
		
		/* @var $entityManager EntityManager */
		$entityManager = $this->serviceLocator->get('Doctrine\ORM\EntityManager');
		
		$territories = $entityManager->getRepository('Application\Entity\Territory')->findAll();
		$annualPeriods = $entityManager->getRepository('Application\Entity\AnnualPeriod')->findAll();
		$domains = $entityManager->getRepository('Expenditure\Entity\Domain')->findAll();
		$categories = $entityManager->getRepository('Expenditure\Entity\Category')->findAll();
		$sources = $entityManager->getRepository('Income\Entity\Source')->findAll();
		
		$filterForm->setParameter($this->getReportGeneratorManager()->getParameterStorage()->read());
		
		$filterObject = new ParameterFilterObject($territories, $annualPeriods, $domains, $categories, $sources);
		$filterForm->bind($filterObject);
		
		if($this->request->isPost()) {
			$filterForm->setData($this->request->getPost());
			if($filterForm->isValid()) {
				// Jika reset diklik.
				if($this->request->getPost('reset') === $filterForm->get('reset')->getValue()) {
					$this->getReportGeneratorManager()->getParameterStorage()->reset();
					$this->redirect()->toRoute('report/filter');
				}
				// Jika submit diklik
				else {
					$this->getReportGeneratorManager()->getParameterStorage()->write($filterForm->getParameter());
					$this->redirect()->toRoute('report/detail');
				}
			}
		}
		
		return array(
			'filterForm' => $filterForm
		);
	}
	
	/**
	 * Tampilin detail laporan.
	 */
	public function detailAction() {
		
	}
	
	/**
	 * @return GeneratorManagerInterface
	 */
	protected function getReportGeneratorManager() {
		return $this->getServiceLocator()->get('ReportGeneratorManager');
	}
}