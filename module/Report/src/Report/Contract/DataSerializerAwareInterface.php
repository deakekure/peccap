<?php
namespace Report\Contract;

/**
 * 
 * @author zakyalvan
 *
 */
interface DataSerializerAwareInterface {
	/**
	 * Retrieve data serializer.
	 *
	 * @return DataSerializerInterface
	 */
	public function getDataSerializer();
	
	/**
	 * Set data serializer.
	 *
	 * @param DataSerializerInterface $dataSerializer
	 */
	public function setDataSerializer(DataSerializerInterface $dataSerializer);
}