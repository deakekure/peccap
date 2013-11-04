<?php
namespace Expenditure;

return array(
	'controllers' => array(
		'invokables' => array(
			'Expenditure\Controller\Index' => 'Expenditure\Controller\IndexController'
		)
	),
		'router' => array(
				'routes' => array(
						'expenditure' => array(
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array(
										'route'    => '/expenditure',
										'defaults' => array(
												'controller' => 'Expenditure\Controller\Index',
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
																'controller' => 'Expenditure\Controller\Index',
																'action' => 'index'
														)
												)
										)
								)
						)
				)
		),
	'view_manager' => array(
		'template_path_stack' => array(
			__DIR__ . '/../view',
		)
	),
	'form_elements' => array(
		'invokables' => array(
			'Expenditure\Form\Fieldset\Domain' => 'Expenditure\Form\Fieldset\Domain',
			'Expenditure\Form\Fieldset\Category' => 'Expenditure\Form\Fieldset\Category'
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
	)
);