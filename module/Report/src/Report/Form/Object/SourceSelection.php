<?php
namespace Report\Form\Object;

use Income\Entity\Source;

/**
 * DTO untuk seource selection.
 * 
 * @author zakyalvan
 */
class SourceSelection {
	public static function createFromSourceArray(array $sources) {
		$sourceSelections = array();
	
		foreach ($sources as $source) {
			$sourceSelection = new self();
			$sourceSelection->setSource($source);
				
			$sourceSelections[] = $sourceSelection;
		}
	
		return $sourceSelections;
	}
	
	private $selection = 0;
	public function getSelection() {
		return $this->selection;
	}
	public function setSelection($selection) {
		$this->selection = $selection;
	}
	
	/**
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