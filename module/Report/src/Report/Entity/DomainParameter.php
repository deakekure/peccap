<?php
namespace Report\Entity;

use Doctrine\ORM\Mapping as Orm;
use Expenditure\Entity\Domain;

/**
 * @Orm\Entity
 * @Orm\Table(name="peccap_report_template_domain")
 * 
 * @author zakyalvan
 */
class DomainParameter {
	/**
	 * @Orm\Id
	 * @Orm\ManyToOne(targetEntity="Report\Entity\Template", fetch="LAZY", inversedBy="domainParameters")
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
	 * @Orm\ManyToOne(targetEntity="Expenditure\Entity\Domain", fetch="LAZY")
	 * @Orm\JoinColumn(name="domain_id", referencedColumnName="id")
	 * 
	 * @var Domain
	 */
	private $domain;
	public function getDomain() {
		return $this->domain;
	}
	public function setDomain(Domain $domain) {
		$this->domain = $domain;
	}
}