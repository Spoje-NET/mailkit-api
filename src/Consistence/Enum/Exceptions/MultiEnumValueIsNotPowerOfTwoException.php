<?php

declare(strict_types = 1);

namespace Igloonet\MailkitApi\Consistence\Enum\Exceptions;

use Igloonet\MailkitApi\Consistence\Exceptions\PhpException;

class MultiEnumValueIsNotPowerOfTwoException extends PhpException
{
	private readonly int $value;

	private readonly string $class;

	public function __construct(int $value, string $class, \Throwable $previous = null)
	{
		parent::__construct(
			sprintf(
				'Value %d in %s is not a power of two, which is needed for MultiEnum to work as expected',
				$value,
				$class
			),
			$previous
		);
		$this->value = $value;
		$this->class = $class;
	}

	public function getValue(): int
	{
		return $this->value;
	}

	public function getClass(): string
	{
		return $this->class;
	}
}
