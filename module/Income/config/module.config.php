<?php
namespace Income;

return array(
	'controllers' => array(
		'invokables' => array(
			'Income\Controller\Index' => 'Income\Controller\IndexController'
		)
	),
	'router' => array(
		'routes' => array(
			'income' => array(
				'type' => 'Zend\Mvc\Router\Http\Literal',
				'options' => array(
					'route'    => '/income',
					'defaults' => array(
						'controller' => 'Income\Controller\Index',
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
								'controller' => 'Income\Controller\Index',
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