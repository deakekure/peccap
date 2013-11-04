<?php
namespace Report\Parameter;

/**
 * Object converter untuk keperluan storage.
 * 
 * @author zakyalvan
 */
interface ConverterInterface {
	public function convertToStorage($object);
	public function convertToParameter($storageObject);
}