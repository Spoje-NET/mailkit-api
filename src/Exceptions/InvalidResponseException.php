<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi\Exceptions;

use Throwable;

class InvalidResponseException extends \RuntimeException implements MailkitApiException
{
	public function __construct(private readonly ?\Igloonet\MailkitApi\RPC\Responses\IRpcResponse $response, string $message = '', int $code = 0, Throwable $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}
}
