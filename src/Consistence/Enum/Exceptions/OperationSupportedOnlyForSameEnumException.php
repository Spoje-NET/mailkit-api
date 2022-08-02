<?php

declare(strict_types = 1);

namespace Igloonet\MailkitApi\Consistence\Enum\Exceptions;

use Igloonet\MailkitApi\Consistence\Enum\Enum;
use Igloonet\MailkitApi\Consistence\Exceptions\PhpException;
use Throwable;

class OperationSupportedOnlyForSameEnumException extends PhpException
{

	/** @var Enum */
	private $given;

	/** @var Enum */
	private $expected;

	public function __construct(Enum $given, Enum $expected, Throwable $previous = null)
	{
		parent::__construct(sprintf(
			'Operation supported only for enum of same class: %s given, %s expected',
			get_class($given),
			get_class($expected)
		), $previous);
		$this->given = $given;
		$this->expected = $expected;
	}

	public function getGiven(): Enum
	{
		return $this->given;
	}

	public function getExpected(): Enum
	{
		return $this->expected;
	}

}
