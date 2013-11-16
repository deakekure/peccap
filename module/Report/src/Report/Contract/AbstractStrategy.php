<?php
namespace Report\Contract;

use Doctrine\Common\Collections\ArrayCollection;
use Report\Contract\Exception\DataSerializingException;

/**
 * Abstract report strategy.
 * 
 * @author zakyalvan
 */
abstract class AbstractStrategy implements StrategyInterface {
	/**
	 * @var string
	 */
	protected $name;
	
	/**
	 * Parameter yang digunakan dalam menggenerate report.
	 * 
	 * @var Parameter
	 */
	protected $parameter;
	
	/**
	 * @var DataProviderInterface
	 */
	protected $dataProvider;
	
	/**
	 * @var DataSerializerInterface
	 */
	protected $dataSerializer;

	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\StrategyInterface::getName()
	 */
	public function getName() {
		return $this->name;
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\StrategyInterface::setName()
	 */
	public function setName($name) {
		$this->name = $name;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\ReportInterface::getParameter()
	 */
	public function getParameter() {
		return $this->parameter;
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\ReportInterface::setParameter()
	 */
	public function setParameter(Parameter $parameter) {
		$this->parameter = $parameter;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\ReportInterface::getDataProvider()
	 */
	public function getDataProvider() {
		return $this->dataProvider;
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\ReportInterface::setDataProvider()
	 */
	public function setDataProvider(DataProviderInterface $dataProvider) {
		$this->dataProvider = $dataProvider;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\DataSerializerAwareInterface::getDataSerializer()
	 */
	public function getDataSerializer() {
		return $this->dataSerializer;
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\DataSerializerAwareInterface::setDataSerializer()
	 */
	public function setDataSerializer(DataSerializerInterface $dataSerializer) {
		$this->dataSerializer = $dataSerializer;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Serializable::serialize()
	 */
	public function serialize() {
		if($this->dataSerializer !== null) {
			return $this->dataSerializer->serialize($this->dataProvider->getDatas());
		}
		throw new DataSerializingException('Serialize object data gagal. Object data-serializer belum diberikan.', 100, null);
	}
	/**
	 * (non-PHPdoc)
	 * @see Serializable::unserialize()
	 */
	public function unserialize($serialized) {
		throw new DataSerializingException('Operasi unserialize tidak diizinkan.', 100, null);
	}
}