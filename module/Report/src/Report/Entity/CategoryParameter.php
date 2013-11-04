<?php
namespace Report\Entity;

use Doctrine\ORM\Mapping as Orm;
use Expenditure\Entity\Category;

/**
 * @Orm\Entity
 * @Orm\Table(name="peccap_report_template_category")
 * 
 * @author zakyalvan
 */
class CategoryParameter {
	/**
	 * @Orm\Id
	 * @Orm\ManyToOne(targetEntity="Report\Entity\Template", fetch="LAZY", inversedBy="categoryParameters")
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
	 * @Orm\ManyToOne(targetEntity="Expenditure\Entity\Category", fetch="LAZY")
	 * @Orm\JoinColumn(name="category_id", referencedColumnName="id")
	 * 
	 * @var Category
	 */
	private $category;
	public function getCategory() {
		return $this->category;
	}
	public function setCategory(Category $category) {
		$this->category = $category;
	}
}