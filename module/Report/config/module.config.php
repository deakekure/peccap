<?php
namespace Report;

return array(
	'controllers' => array(
		'invokables' => array(
			'Report\Controller\Index' => 'Report\Controller\IndexController',
			'Report\Controller\Schema' => 'Report\Controller\SchemaController'
		)
	),
	'view_helpers' => array(
		'invokables' => array(
			'chartRenderer' => 'Report\View\Helper\ChartRenderer',
			'tableRenderer' => 'Report\View\Helper\TableRenderer'
		)
	),
	'router' => array(
		'routes' => array(
			'report' => array(
				'type' => 'Zend\Mvc\Router\Http\Literal',
				'options' => array(
					'route'    => '/report',
					'defaults' => array(
						'controller' => 'Report\Controller\Index',
						'action'     => 'index',
					),
				),
				'may_terminate' => true,
				'child_routes' => array(
					'default' => array(
						'type' => 'Literal',
						'options' => array(
							'route' => '/',
							'defaults' => array(
								'controller' => 'Report\Controller\Index',
								'action' => 'index'
							)
						)
					),
					'filter' => array(
						'type'    => 'Literal',
						'options' => array(
							'route'    => '/filter',
							'defaults' => array(
								'controller' => 'Report\Controller\Index',
								'action'     => 'filter'
							)
						)
					),
					'detail' => array(
						'type'    => 'Literal',
						'options' => array(
							'route'    => '/detail',
							'defaults' => array(
								'controller' => 'Report\Controller\Index',
								'action'     => 'detail'
							)
						)
					),
					'template' => array(
						'type'    => 'Segment',
						'options' => array(
							'route'    => '/template[/:template]',
							'constraints' => array(
								'template' => '[0-9]*',
							),
							'defaults' => array(
								'controller' => 'Report\Controller\Index',
								'action'     => 'template'
							)
						)
					)
				)
			),
			'schema' => array(
				'type' => 'Zend\Mvc\Router\Http\Segment',
				'options' => array(
					'route'    => '/report/schema[/:action]',
					'constraints' => array(
						'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'Report\Controller\Schema',
						'action'     => 'index',
					),
				)
			)
		)
	),
	'form_elements' => array(
		'invokables' => array(
			'Report\Form\ParameterFilter' => 'Report\Form\ParameterFilter',
			'Report\Form\Fieldset\ParameterFieldset' => 'Report\Form\Fieldset\ParameterFieldset',
			'Report\Form\Fieldset\TerritorySelection' => 'Report\Form\Fieldset\TerritorySelection',
			'Report\Form\Fieldset\AnnualPeriodSelection' => 'Report\Form\Fieldset\AnnualPeriodSelection',
			'Report\Form\Fieldset\DomainSelection' => 'Report\Form\Fieldset\DomainSelection',
			'Report\Form\Fieldset\CategorySelection' => 'Report\Form\Fieldset\CategorySelection',
			'Report\Form\Fieldset\SourceSelection' => 'Report\Form\Fieldset\SourceSelection'
		),
		'aliases' => array(
			'ParameterFilter' => 'Report\Form\ParameterFilter',
			'ParameterFieldset' => 'Report\Form\Fieldset\ParameterFieldset',
			'TerritorySelection' => 'Report\Form\Fieldset\TerritorySelection',
			'AnnualPeriodSelection' => 'Report\Form\Fieldset\AnnualPeriodSelection',
			'DomainSelection' => 'Report\Form\Fieldset\DomainSelection',
			'CategorySelection' => 'Report\Form\Fieldset\CategorySelection',
			'SourceSelection' => 'Report\Form\Fieldset\SourceSelection'
		)
	),
	'view_manager' => array(
		'template_path_stack' => array(
			__DIR__ . '/../view',
		)
	),
	'service_manager' => array(
		'factories' => array(
			'ReportGeneratorManager' => 'Report\Generator\Service\GeneratorManagerFactory'
		),
		'aliases' => array(
			'Report\Generator\Service\GeneratorManager' => 'ReportGeneratorManager'
		)
	),
	'doctrine' => array(
		'driver' => array(
			__NAMESPACE__ . '_driver' => array(
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => array(
					__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'
				)
			),
			'orm_default' => array (
				'drivers' => array (
					__NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
				)
			)
		)
	),
	'report' => array(
		'generators' => array(
			'1' => 'Report\Generator\PeriodicalTerritoryTotalExpenditureGenerator',
			'2' => 'Report\Generator\PeriodicalTerritoryTotalIncomeGenerator'
		)
	)
);