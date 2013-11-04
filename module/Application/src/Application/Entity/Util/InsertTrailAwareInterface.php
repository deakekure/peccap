<?php
namespace Application\Entity\Util;

/**
 * 
 * @author zakyalvan
 */
interface InsertTrailAwareInterface {
	/**
	 * @return \DateTime
	 */
	public function getCreatedAt();
	public function setCreatedAt(\DateTime $createdAt);
	
	public function getCreatedBy();
	public function setCreatedBy($userId);
}