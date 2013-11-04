<?php
namespace Report\Entity;

use Doctrine\ORM\Mapping as Orm;
use Application\Entity\Territory;

/**
 * @Orm\Entity
 * @Orm\Table(name="peccap_report_template_territory")
 * 
 * @author zakyalvan
 */
class TerritoryParameter {
	/**
	 * @Orm\Id
	 * @Orm\ManyToOne(targetEntity="Report\Entity\Template", fetch="LAZY", inversedBy="territoryParameters")
	 * @Orm\JoinColumn(name="template_id", referencedColumnName="id")
	 *
	 * @var Template
	 */
	private $template;
	public function getTemplate() {
		return $this->template;
	}
	public function setTemplate(Template $template) {
		$this->template = $template;
	}
	
	/**
	 * @Orm\Id
	 * @Orm\ManyToOne(targetEntity="Application\Entity\Territory", fetch="LAZY")
	 * @Orm\JoinColumn(name="territory_id", referencedColumnName="id")
	 * 
	 * @var Territory
	 */
	private $territory;
	public function getTerritory() {
		return $this->territory;
	}
	public function setTerritory(Territory $territory) {
		$this->territory = $territory;
	}
}