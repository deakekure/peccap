<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as Orm;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entity wilayah adaministratif pemerintahan.
 * 
 * @Orm\Entity
 * @Orm\Table(name="peccap_territory")
 * 
 * @author zakyalvan
 */
class Territory {
	const TYPE_PROVINCE = 1;
	const TYPE_DISTRICT = 2;
	
	/**
	 * @Orm\Id
	 * @Orm\Column(name="id", type="string", length=255)
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
	 * @Orm\Column(name="name", type="string", length=255, unique=true)
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
	 * @Orm\Column(name="type", type="integer", length=1)
	 * 
	 * @var integer
	 */
	private $type;
	public function getType() {
		return $this->type;
	}
	public function setType($type) {
		$this->type = $type;
	}
	
	/**
	 * @Orm\ManyToOne(targetEntity="Application\Entity\Territory", fetch="LAZY", inversedBy="children")
	 * @Orm\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
	 * 
	 * @var Territory
	 */
	private $parent;
	public function getParent() {
		return $this->parent;
	}
	public function setParent(Territory $parent) {
		$this->parent = $parent;
	}
	
	/**
	 * @Orm\OneToMany(targetEntity="Application\Entity\Territory", fetch="LAZY", mappedBy="parent")
	 * 
	 * @var ArrayCollection
	 */
	private $children;
	public function getChildren() {
		return $this->children;
	}
	public function setChildren(ArrayCollection $children) {
		$this->children = $children;
	}
	public function addChildren(ArrayCollection $children) {
		foreach ($children as $child) {
			$this->children->add($child);
		}
	}
	public function removeChildren(ArrayCollection $children) {
		foreach ($children as $child) {
			$this->children->removeElement($child);
		}
	}
	
	/**
	 * @Orm\OneToMany(targetEntity="Application\Entity\Population", fetch="LAZY", mappedBy="territory")
	 * 
	 * @var ArrayCollection
	 */
	private $populations;
	public function getPopulations() {
		return $this->populations;
	}
	public function setPopulations(ArrayCollection $populations) {
		$this->populations = $populations;
	}
	public function addPopulations(ArrayCollection $populations) {
		foreach ($populations as $population) {
			$this->populations->add($population);
		}
	}
	public function removePopulations(ArrayCollection $populations) {
		foreach ($populations as $population) {
			$this->populations->removeElement($population);
		}
	}
	
	public function __toString() {
		return $this->name;
	}
}