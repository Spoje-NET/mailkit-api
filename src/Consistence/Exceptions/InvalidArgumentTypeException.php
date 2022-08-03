<?php

declare(strict_types = 1);

namespace Igloonet\MailkitApi\Consistence\Exceptions;

use Igloonet\MailkitApi\Consistence\Type\Type;

class InvalidArgumentTypeException extends InvalidArgumentException
{
	private readonly string $valueType;

	/**
	 * @param mixed $value
	 * @param string $expectedTypes
	 * @param \Throwable|null $previous
	 */
	public function __construct(private $value, private readonly string $expectedTypes, \Throwable $previous = null)
	{
		$this->valueType = Type::getType($value);
		parent::__construct(
			sprintf('%s expected, %s [%s] given', $this->expectedTypes, $this->getPrintedValue($value), $this->valueType),
			$previous
		);
	}

	/**
	 * @param mixed $value
	 */
	private function getPrintedValue($value): string
	{
		$printedValue = $value;
		if (is_object($value) && method_exists($value, '__toString') === false) {
			return $value::class . $this->getObjectHash($value);
		}
		if (is_array($value)) {
			return '';
		}

		return (string) $printedValue;
	}

	/**
	 * @param object $value
	 */
	private function getObjectHash($value): string
	{
		return '#' . substr(md5(spl_object_hash($value)), 0, 4);
	}

	/**
	 * @return mixed
	 */
	public function getValue()
	{
		return $this->value;
	}

	public function getValueType(): string
	{
		return $this->valueType;
	}

	public function getExpectedTypes(): string
	{
		return $this->expectedTypes;
	}
}
