<?php

declare(strict_types = 1);

namespace Igloonet\MailkitApi\Consistence\Enum\Exceptions;

use Igloonet\MailkitApi\Consistence\Enum\Enum;
use Igloonet\MailkitApi\Consistence\Exceptions\PhpException;

class NoSingleEnumSpecifiedException extends PhpException
{
	private readonly string $class;

	public function __construct(string $class, \Throwable $previous = null)
	{
		parent::__construct(
			sprintf(
				'There is no single Enum (implementing %s) defined for MultiEnum %s',
				Enum::class,
				$class
			),
			$previous
		);
		$this->class = $class;
	}

	public function getClass(): string
	{
		return $this->class;
	}
}
