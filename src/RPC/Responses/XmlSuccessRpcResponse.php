<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi\RPC\Responses;

use Igloonet\MailkitApi\RPC\Exceptions\InvalidDataTypeException;
use Igloonet\MailkitApi\RPC\Exceptions\UnsupportedDataTypeException;

final class XmlSuccessRpcResponse extends SuccessRpcResponse
{
	/**
	 * @param mixed[]|null $arrayValue
	 * @param string|null $stringValue
	 * @param int|null $integerValue
	 * @param bool|null $booleanValue
	 */
	public function __construct(protected ?array $arrayValue, protected ?string $stringValue, protected ?int $integerValue, protected ?bool $booleanValue)
	{
	}

	/**
	 * @param mixed[]|string|int|bool $data
	 *
	 * @throws UnsupportedDataTypeException
	 */
	public static function createFromResponseData(array|string|int|bool $data): self
	{
		if (is_array($data)) {
			return new self($data, null, null, null);
		} elseif (is_string($data)) {
			return new self(null, $data, null, null);
		} elseif (is_numeric($data)) {
			return new self(null, null, $data, null);
		} elseif (is_bool($data)) {
			return new self(null, null, null, $data);
		} else {
			throw new UnsupportedDataTypeException(
				sprintf(
					'%s does not support data type %s. Supports only array, string or integer data type.',
					static::class,
					get_debug_type($data)
				)
			);
		}
	}

	/**
	 * @return mixed[]
	 * @throws InvalidDataTypeException
	 */
	public function getArrayValue(): array
	{
		if ($this->arrayValue === null) {
			throw new InvalidDataTypeException(
				sprintf(
					'Unable to get array value from response %s',
					print_r($this, true)
				)
			);
		}

		return $this->arrayValue;
	}

	/**
	 * @throws InvalidDataTypeException
	 */
	public function getStringValue(): string
	{
		if ($this->stringValue === null) {
			throw new InvalidDataTypeException(
				sprintf(
					'Unable to get string value from response %s',
					print_r($this, true)
				)
			);
		}

		return $this->stringValue;
	}

	/**
	 * @throws InvalidDataTypeException
	 */
	public function getIntegerValue(): int
	{
		if ($this->integerValue === null) {
			throw new InvalidDataTypeException(
				sprintf(
					'Unable to get integer value from response %s',
					print_r($this, true)
				)
			);
		}

		return $this->integerValue;
	}

	/**
	 * @throws InvalidDataTypeException
	 */
	public function getBooleanValue(): bool
	{
		if ($this->booleanValue === null) {
			throw new InvalidDataTypeException(
				sprintf(
					'Unable to get boolean value from response %s',
					print_r($this, true)
				)
			);
		}

		return $this->booleanValue;
	}

	/**
	 * @return mixed[]
	 * @throws InvalidDataTypeException
	 */
	public function getArrayData(): array
	{
		if ($this->arrayValue === null || !isset($this->arrayValue['data']) || !is_array($this->arrayValue['data'])) {
			throw new InvalidDataTypeException(
				sprintf(
					'Unable to extract array data from response %s',
					print_r($this, true)
				)
			);
		}

		return $this->arrayValue['data'];
	}

	/**
	 * @throws InvalidDataTypeException
	 */
	public function getStringData(): string
	{
		if ($this->arrayValue === null || !isset($this->arrayValue['data']) || !is_string($this->arrayValue['data'])) {
			throw new InvalidDataTypeException(
				sprintf(
					'Unable to extract string data from response %s',
					print_r($this, true)
				)
			);
		}

		return $this->arrayValue['data'];
	}

	/**
	 * @throws InvalidDataTypeException
	 */
	public function getIntegerData(): int
	{
		if ($this->arrayValue === null || !isset($this->arrayValue['data']) || !is_numeric($this->arrayValue['data'])) {
			throw new InvalidDataTypeException(
				sprintf(
					'Unable to extract integer data from response %s',
					print_r($this, true)
				)
			);
		}

		return (int) $this->arrayValue['data'];
	}

	/**
	 * @throws InvalidDataTypeException
	 */
	public function getBooleanData(): bool
	{
		if ($this->arrayValue === null || !isset($this->arrayValue['data']) || !is_bool($this->arrayValue['data'])) {
			throw new InvalidDataTypeException(
				sprintf(
					'Unable to extract boolean data from response %s',
					print_r($this, true)
				)
			);
		}

		return $this->arrayValue['data'];
	}
}
