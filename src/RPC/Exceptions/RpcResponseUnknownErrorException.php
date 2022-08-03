<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi\RPC\Exceptions;

use Throwable;

class RpcResponseUnknownErrorException extends BaseRpcException
{
	/**
	 * @param string $method
	 * @param mixed[] $requestData
	 * @param string $error
	 * @param mixed[] $possibleErrors
	 * @param string $message
	 * @param int $code
	 * @param Throwable|null $previous
	 */
	public function __construct(
		string $method,
		array $requestData,
		protected string $error,
		protected array $possibleErrors,
		string $message = '',
		int $code = 0,
		Throwable $previous = null
	) {
		parent::__construct($method, $requestData, $message, $code, $previous);
	}

	protected function getDefaultMessage(): string
	{
		return sprintf(
			'Unknown RPC error returned: %s. Possible errors: %s',
			$this->error,
			implode(',', $this->possibleErrors)
		);
	}
}
