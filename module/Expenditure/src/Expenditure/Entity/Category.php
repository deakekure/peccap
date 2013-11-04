<?php
namespace Expenditure\Entity;

use Doctrine\ORM\Mapping as Orm;

/**
 * Entity kategori atau jenis belanja anggaran.
 * 
 * @Orm\Entity
 * @Orm\Table(name="peccap_expenditure_category")
 * 
 * @author zakyalvan
 */
class Category {
	/**
	 * @Orm\Id
	 * @Orm\Column(name="id", type="string", length=50)
	 * @Orm\GeneratedValue(strategy="NONE")
	 * 
	 * @var string
	 */
	private $id;
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}
	
	/**
	 * @Orm\Column(name="description", type="string", length=255, nullable=false)
	 * 
	 * @var string
	 */
	private $description;
	public function getDescription() {
		return $this->description;
	}
	public function setDescription($description) {
		$this->description = $description;
	}
	
	/**
	 * @Orm\Column(name="order_number", type="integer", length=1, nullable=true)
	 *
	 * @var integer
	 */
	private $orderNumber;
}