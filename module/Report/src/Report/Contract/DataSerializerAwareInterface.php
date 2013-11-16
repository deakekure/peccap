<?php
namespace Report\Contract;

/**
 * Kontrak data serializer.
 * Object kelas yang mengimplementasi interface ini akan digunakan oleh report strategy 
 * dalam menggenerate (representasi) data yang sesuai dengan strategy (misalnya chart, tabular, map dll)
 * 
 * @author zakyalvan
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