<?php

declare(strict_types = 1);

namespace Igloonet\MailkitApi\Consistence\Enum\Exceptions;

use Igloonet\MailkitApi\Consistence\Exceptions\PhpException;
use Igloonet\MailkitApi\Consistence\Type\Type;

class InvalidEnumValueException extends PhpException
{
	/** @var mixed */
	private $value;

	/** @var mixed[] */
	private readonly array $availableValues;

	/**
	 * @param mixed $value
	 * @param mixed[] $availableValues
	 * @param \Throwable|null $previous
	 */
	public function __construct($value, array $availableValues, \Throwable $previous = null)
	{
		parent::__construct(
			sprintf(
				'%s [%s] is not a valid value, accepted values: %s',
				$value,
				Type::getType($value),
				implode(', ', $availableValues)
			),
			$previous
		);
		$this->value = $value;
		$this->availableValues = $availableValues;
	}

	/**
	 * @return mixed
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * @return mixed[]
	 */
	public function getAvailableValues(): array
	{
		return $this->availableValues;
	}
}
