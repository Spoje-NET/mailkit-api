<?php

declare(strict_types = 1);

namespace Igloonet\MailkitApi\Consistence\Type\ArrayType;

use Igloonet\MailkitApi\Consistence\Exceptions\InvalidArgumentTypeException;
use Igloonet\MailkitApi\Consistence\ObjectPrototype;
use Igloonet\MailkitApi\Consistence\Type\Type;

class KeyValuePair extends ObjectPrototype
{

	/** @var int|string */
	private $key;

	/** @var mixed */
	private $value;

	/**
	 * @param int|string $key
	 * @param mixed $value
	 *
	 * @throws InvalidArgumentTypeException
	 */
	public function __construct($key, $value)
	{
		$this->setPair($key, $value);
	}

	/**
	 * @param int|string $key
	 * @param mixed $value
	 *
	 * @throws InvalidArgumentTypeException
	 */
	protected function setPair($key, $value): void
	{
		Type::checkType($key, 'int|string');
		$this->key = $key;
		$this->value = $value;
	}

	/**
	 * @return int|string
	 */
	public function getKey()
	{
		return $this->key;
	}

	/**
	 * @return mixed
	 */
	public function getValue()
	{
		return $this->value;
	}

}
