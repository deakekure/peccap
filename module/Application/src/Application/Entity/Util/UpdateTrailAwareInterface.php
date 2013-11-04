<?php
namespace Application\Entity\Util;

interface UpdateTrailAwareInterface {
	/**
	 * @return \DateTime
	 */
	public function getUpdatedAt();
	public function setUpdatedAt(\DateTime $updatedAt);
	
	public function getUpdatedBy();
	public function setUpdatedBy($userId);
}