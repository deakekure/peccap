<?php
namespace Report\Entity;

use Doctrine\ORM\Mapping as Orm;
use Income\Entity\Source;

/**
 * @Orm\Entity
 * @Orm\Table(name="peccap_report_template_source")
 * 
 * @author zakyalvan
 */
class SourceParameter {
	/**
	 * @Orm\Id
	 * @Orm\ManyToOne(targetEntity="Report\Entity\Template", fetch="LAZY", inversedBy="sourceParameters")
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
	 * @Orm\ManyToOne(targetEntity="Income\Entity\Source", fetch="LAZY")
	 * @Orm\JoinColumn(name="source_id", referencedColumnName="name")
	 * 
	 * @var Source
	 */
	private $source;
	public function getSource() {
		return $this->source;
	}
	public function setSource(Source $source) {
		$this->source = $source;
	}
}