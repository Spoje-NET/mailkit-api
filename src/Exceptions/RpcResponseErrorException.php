<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi\Exceptions;

use Igloonet\MailkitApi\RPC\Responses\IRpcResponse;
use Throwable;

abstract class RpcResponseErrorException extends \RuntimeException implements MailkitApiException
{
	public function __construct(
		private readonly IRpcResponse $rpcResponse,
		string $message = '',
		int $code = 0,
		Throwable $previous = null
	) {
		if (trim($message) === '') {
			$message = $rpcResponse->getError() ?? '';
			$code = $rpcResponse->getErrorCode() ?? 0;
		}

		parent::__construct($message, $code, $previous);
	}

	public function getRpcResponse(): ?IRpcResponse
	{
		return $this->rpcResponse;
	}
}
