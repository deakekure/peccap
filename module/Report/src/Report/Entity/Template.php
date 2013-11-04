<?php
namespace Report\Entity;

use Doctrine\ORM\Mapping as Orm;
use Doctrine\Common\Collections\ArrayCollection;
use Application\Entity\User;

/**
 * @Orm\Entity
 * @Orm\Table(name="peccap_report_template")
 * 
 * @author zakyalvan
 */
class Template {
	public function __construct() {
		$this->territoryParameters = new ArrayCollection();
		$this->annualPeriodParameters = new ArrayCollection();
		$this->domainParameters = new ArrayCollection();
		$this->categoryParameters = new ArrayCollection();
		$this->sourceParameters = new ArrayCollection();
	}
	
	/**
	 * @Orm\Id
	 * @Orm\Column(name="id", type="integer")
	 * @Orm\GeneratedValue(strategy="IDENTITY")
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
	 * Nama dari template.
	 * 
	 * @Orm\Column(name="template_name", type="string", length=255, nullable=true)
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
	 * @Orm\ManyToOne(targetEntity="Application\Entity\User", fetch="LAZY")
	 * @Orm\JoinColumn(name="owner_id", referencedColumnName="id")
	 * 
	 * @var User
	 */
	private $owner;
	public function getOwner() {
		return $this->owner;
	}
	public function setOwner(User $owner) {
		$this->owner = $owner;
	}
	
	/**
	 * @Orm\Column(name="shared", type="integer", length=1)
	 * 
	 * @var integer
	 */
	private $shared = 0;
	public function getShared() {
		return $this->shared;
	}
	public function setShared($shared) {
		$this->shared = $shared;
	}
	
	/**
	 * @Orm\Column(name="sharing_note", type="string", length=255, nullable=true)
	 *
	 * @var string
	 */
	private $sharingNote;
	public function getSharingNote() {
		return $this->sharingNote;
	}
	public function setSharingNote($sharingNote) {
		$this->sharingNote = $sharingNote;
	}
	
	/**
	 * @Orm\OneToMany(targetEntity="Report\Entity\TerritoryParameter", fetch="LAZY", mappedBy="template")
	 * 
	 * @var ArrayCollection
	 */
	private $territoryParameters;
	public function getTerritoryParameters() {
		return $this->territoryParameters;
	}
	public function setTerritoryParameters(ArrayCollection $territoryParameters) {
		$this->territoryParameters = $territoryParameters;
	}
	
	/**
	 * @Orm\OneToMany(targetEntity="Report\Entity\AnnualPeriodParameter", fetch="LAZY", mappedBy="template")
	 * 
	 * @var ArrayCollection
	 */
	private $annualPeriodParameters;
	public function getAnnualPeriodParameters() {
		return $this->annualPeriodParameters;
	}
	public function setAnnualPeriodParameters(ArrayCollection $annualPeriodParameters) {
		$this->annualPeriodParameters;
	}
	
	/**
	 * @Orm\OneToMany(targetEntity="Report\Entity\DomainParameter", fetch="LAZY", mappedBy="template")
	 * 
	 * @var ArrayCollection
	 */
	private $domainParameters;
	public function getDomainParameters() {
		return $this->domainParameters;
	}
	public function setDomainParameters(ArrayCollection $domainParameters) {
		$this->domainParameters = $domainParameters;
	}
	
	/**
	 * @Orm\OneToMany(targetEntity="Report\Entity\CategoryParameter", fetch="LAZY", mappedBy="template")
	 * 
	 * @var ArrayCollection
	 */
	private $categoryParameters;
	public function getCategoryParameters() {
		return $this->categoryParameters;
	}
	public function setCategoryParameters(ArrayCollection $categoryParameters) {
		$this->categoryParameters = $categoryParameters;
	}
	
	/**
	 * @Orm\OneToMany(targetEntity="Report\Entity\SourceParameter", fetch="LAZY", mappedBy="template")
	 *
	 * @var ArrayCollection
	 */
	private $sourceParameters;
	public function getSourceParameters() {
		return $this->sourceParameters;
	}
	public function setSourceParameters(ArrayCollection $sourceParameters) {
		$this->sourceParameters = $sourceParameters;
	}
}