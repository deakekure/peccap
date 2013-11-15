<?php
namespace Report\Contract;

use Doctrine\Common\Collections\ArrayCollection;
use Report\Contract\Exception\DataSerializingException;
/**
 * Kontrak untuk data-serializer object.
 * Kelas dari interface interface ini akan digunakan dalam strategy.
 * 
 * @author zakyalvan
 */
interface DataSerializerInterface {
	/**
	 * Serialize datas ke bentuk string.
	 * 
	 * @param ArrayCollection $datas
	 * @throws DataSerializingException
	 * @return string
	 */
	public function serialize(ArrayCollection $datas);
}