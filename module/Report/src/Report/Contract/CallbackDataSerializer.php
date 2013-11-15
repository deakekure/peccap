<?php
namespace Report\Contract;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Callback data serializer.
 * 
 * @author zakyalvan
 */
class CallbackDataSerializer implements DataSerializerInterface {
	private $options = array();
	
	public function __construct($callback) {
		if(!is_callable($callback)) {
			throw new \InvalidArgumentException('Parameter callback harus callable', 100, null);
		}
		$this->options['callback'] = $callback;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\DataSerializerInterface::serialize()
	 */
	public function serialize(ArrayCollection $datas) {
		$callback = $this->options['callback'];
		return $callback($datas);
	}
}