<?php
namespace Report\Controller;

use Zend\Mvc\Controller\AbstractActionController;

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
		/* @var $filterForm ExpenditureFilterForm */
		$filterForm = $this->serviceLocator->get('FormElementManager')->get('Report\Form\ExpenditureFilter');
		
		/* @var $entityManager EntityManager */
		$entityManager = $this->serviceLocator->get('Doctrine\ORM\EntityManager');
		
		$territories = $entityManager->getRepository('Application\Entity\Territory')->findAll();
		$domains = $entityManager->getRepository('Expenditure\Entity\Domain')->findAll();
		$categories = $entityManager->getRepository('Expenditure\Entity\Category')->findAll();
		$annualPerriods = $entityManager->getRepository('Application\Entity\AnnualPeriod')->findAll();
		
		$filterObject = new ExpenditureFilterObject($territories, $domains, $categories, $annualPerriods);
		$filterForm->bind($filterObject);
		
		if($this->request->isPost()) {
			$filterForm->setData($this->request->getPost());
			if($filterForm->isValid()) {
				$validFilterObject = $filterForm->getObject();
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
}