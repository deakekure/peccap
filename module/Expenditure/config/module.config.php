<?php
namespace Expenditure;

return array(
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