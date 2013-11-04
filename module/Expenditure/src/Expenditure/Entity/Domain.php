<?php
namespace Expenditure\Entity;

use Doctrine\ORM\Mapping as Orm;

/**
 * Entity fungsi pengeluaran.
 * 
 * @Orm\Entity
 * @Orm\Table(name="peccap_expenditure_domain")
 * 
 * @author zakyalvan
 */
class Domain {
	/**
	 * @Orm\Id
	 * @Orm\Column(name="id", type="string", length=20)
	 * @Orm\GeneratedValue(strategy="NONE")
	 * 
	 * @var integer
	 */
	private $id;
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}
	
	/**
	 * @Orm\Column(name="name", type="string", length=255, nullable=false)
	 * 
	 * @var string
	 */
	private $name;
	public function getName() {
		return $this->name;
	}
	public function setName($name) {
		$this->name = $name;
	}
	
	/**
	 * @Orm\Column(name="order_number", type="integer", length=1, nullable=true)
	 * 
	 * @var integer
	 */
	private $orderNumber;
}