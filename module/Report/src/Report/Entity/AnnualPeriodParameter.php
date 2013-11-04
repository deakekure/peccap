<?php
namespace Report\Entity;

use Doctrine\ORM\Mapping as Orm;
use Application\Entity\AnnualPeriod;

/**
 * @Orm\Entity
 * @Orm\Table(name="peccap_report_template_annual_period")
 * 
 * @author zakyalvan
 */
class AnnualPeriodParameter {
	/**
	 * @Orm\Id
	 * @Orm\ManyToOne(targetEntity="Report\Entity\Template", fetch="LAZY", inversedBy="annualPeriodParameters")
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
	 * @Orm\ManyToOne(targetEntity="Application\Entity\AnnualPeriod", fetch="LAZY")
	 * @Orm\JoinColumn(name="annual_period", referencedColumnName="year")
	 * 
	 * @var AnnualPeriod
	 */
	private $annualPeriod;
	public function getAnnualPeriod() {
		return $this->annualPeriod;
	}
	public function setAnnualPeriod(AnnualPeriod $annualPeriod) {
		$this->annualPeriod = $annualPeriod;
	}
}