<?php

declare(strict_types = 1);

namespace Igloonet\MailkitApi\Consistence\Exceptions;

class UndefinedMethodException extends PhpException
{
	private readonly string $className;

	private readonly string $methodName;

	public function __construct(string $className, string $methodName, \Throwable $previous = null)
	{
		parent::__construct(sprintf('Method %s::%s() is not defined or is not accessible', $className, $methodName), $previous);
		$this->className = $className;
		$this->methodName = $methodName;
	}

	public function getClassName(): string
	{
		return $this->className;
	}

	public function getMethodName(): string
	{
		return $this->methodName;
	}
}
