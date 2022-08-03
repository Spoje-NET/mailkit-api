<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi\RPC\Exceptions;

class InvalidRpcResponseException extends BaseRpcResponseException
{
	protected function getDefaultMessage(): string
	{
		return sprintf('Invalid response for API request %s', $this->method);
	}
}
