<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi\RPC\Exceptions;

use Throwable;

abstract class BaseRpcException extends \RuntimeException implements RpcException
{
	/**
	 * @param string $method
	 * @param mixed[] $requestData
	 * @param string $message
	 * @param int $code
	 * @param Throwable|null $previous
	 */
	public function __construct(
		protected string $method,
		protected array $requestData,
		string $message = '',
		int $code = 0,
		Throwable $previous = null
	) {
		parent::__construct($message, $code, $previous);

		if (trim($this->message) === '') {
			$this->message = $this->getDefaultMessage();
		}
	}

	abstract protected function getDefaultMessage(): string;

	/**
	 * @return string
	 */
	public function getMethod(): string
	{
		return $this->method;
	}

	/**
	 * @return mixed
	 */
	public function getRequestData()
	{
		return $this->requestData;
	}
}
