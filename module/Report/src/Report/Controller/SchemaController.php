<?php
namespace Report\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaValidator;

class SchemaController extends AbstractActionController {
	public function indexAction() {
		$validator = new SchemaValidator($this->getEntityManager());
		
		return array(
			
		);
	}
	
	public function createAction() {
		$entityManager = $this->getEntityManager();
		
		$tool = new SchemaTool($entityManager);
		$classes = $entityManager->getMetadataFactory()->getAllMetadata();
		$createSql = $tool->getCreateSchemaSql($classes);
		$tool->updateSchema($classes);
		
		return array(
			'createSql' => $createSql
		);
	}
	
	public function validateAction() {
		$validator = new SchemaValidator($this->getEntityManager());
		$errors = $validator->validateMapping();
		
		return array(
			'errors' => $errors
		);
	}
	
	public function dropAction() {
		$entityManager = $this->getEntityManager();
		$classes = $entityManager->getMetadataFactory()->getAllMetadata();
		$tool = new SchemaTool($entityManager);
		$dropSql = $tool->getDropSchemaSQL($classes);
		$tool->dropSchema($classes);
		
		return array(
			'dropSql' => $dropSql
		);
	}
	
	/**
	 * @return EntityManager
	 */
	protected function getEntityManager() {
		return $this->serviceLocator->get('Doctrine\ORM\EntityManager');
	}
}