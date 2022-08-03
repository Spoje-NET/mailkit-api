<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi\RPC\Responses;

use Igloonet\MailkitApi\RPC\Exceptions\InvalidDataTypeException;

abstract class ErrorRpcResponse implements IRpcResponse
{
	public function __construct(protected ?string $error, protected ?int $errorCode = 0)
	{
	}

	public function getStatus(): string
	{
		return self::STATUS_ERROR;
	}

	public function isError(): bool
	{
		return true;
	}

	public function getError(): ?string
	{
		return $this->error;
	}

	public function getErrorCode(): ?int
	{
		return $this->errorCode;
	}

	/**
	 * @return mixed[]
	 * @throws InvalidDataTypeException
	 */
	public function getArrayValue(): array
	{
		throw new InvalidDataTypeException('Unable to get array value from error response');
	}

	/**
	 * @throws InvalidDataTypeException
	 */
	public function getStringValue(): string
	{
		throw new InvalidDataTypeException('Unable to get string value from error response');
	}

	/**
	 * @throws InvalidDataTypeException
	 */
	public function getIntegerValue(): int
	{
		throw new InvalidDataTypeException('Unable to get integer value from error response');
	}

	/**
	 * @throws InvalidDataTypeException
	 */
	public function getBooleanValue(): bool
	{
		throw new InvalidDataTypeException('Unable to get boolean value from error response');
	}

	/**
	 * @return mixed[]
	 * @throws InvalidDataTypeException
	 */
	public function getArrayData(): array
	{
		throw new InvalidDataTypeException('Unable to extract array data from error response');
	}

	/**
	 * @throws InvalidDataTypeException
	 */
	public function getStringData(): string
	{
		throw new InvalidDataTypeException('Unable to extract string data from error response');
	}

	/**
	 * @throws InvalidDataTypeException
	 */
	public function getIntegerData(): int
	{
		throw new InvalidDataTypeException('Unable to extract integer data from error response');
	}

	/**
	 * @throws InvalidDataTypeException
	 */
	public function getBooleanData(): bool
	{
		throw new InvalidDataTypeException('Unable to extract boolean data from error response');
	}
}
