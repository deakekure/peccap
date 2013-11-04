<?php
namespace Report\Form\Object;

use Expenditure\Entity\Category;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Form backing object untuk pemilihan jenis belanja.
 * 
 * @author zakyalvan
 */
class CategorySelection {
	public static function createFromCategoryArray(array $categories) {
		$categorieSelections = array();
		
		foreach ($categories as $category) {
			$categorieSelection = new CategorySelection();
			$categorieSelection->setCategory($category);
			$categorieSelections[] = $categorieSelection;
		}
		
		return $categorieSelections;
	}
	
	/**
	 * @var boolean
	 */
	private $selection = 0;
	public function getSelection() {
		return $this->selection;
	}
	public function setSelection($selection) {
		$this->selection = $selection;
	}
	
	/**
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