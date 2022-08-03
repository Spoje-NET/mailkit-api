<?php

declare(strict_types = 1);

namespace Igloonet\MailkitApi\Consistence\Enum;

use Igloonet\MailkitApi\Consistence\Enum\Exceptions\DuplicateValueSpecifiedException;
use Igloonet\MailkitApi\Consistence\Enum\Exceptions\InvalidEnumValueException;
use Igloonet\MailkitApi\Consistence\Enum\Exceptions\OperationSupportedOnlyForSameEnumException;
use Igloonet\MailkitApi\Consistence\Exceptions\InvalidArgumentTypeException;
use Igloonet\MailkitApi\Consistence\ObjectPrototype;
use Igloonet\MailkitApi\Consistence\Reflection\ClassReflection;
use Igloonet\MailkitApi\Consistence\Type\ArrayType\ArrayType;
use Igloonet\MailkitApi\Consistence\Type\ArrayType\KeyValuePair;
use Igloonet\MailkitApi\Consistence\Type\Type;
use ReflectionClass;

abstract class Enum extends ObjectPrototype
{
	/** @var self[] indexed by enum and value */
	private static array $instances = [];

	/** @var mixed[] format: enum name (string) => cached values (const name (string) => value (mixed)) */
	private static $availableValues;

	/** @var mixed */
	private $value;

	/**
	 * @param mixed $value
	 *
	 * @throws InvalidEnumValueException
	 */
	final private function __construct($value)
	{
		static::checkValue($value);
		$this->value = $value;
	}

	/**
	 * @param mixed $value
	 *
	 * @throws InvalidEnumValueException
	 */
	public static function checkValue($value): void
	{
		if (!static::isValidValue($value)) {
			throw new InvalidEnumValueException($value, static::getAvailableValues());
		}
	}

	/**
	 * @param mixed $value
	 */
	public static function isValidValue($value): bool
	{
		return ArrayType::containsValue(static::getAvailableValues(), $value);
	}

	/**
	 * @return mixed[] format: const name (string) => value (mixed)
	 * @throws DuplicateValueSpecifiedException
	 */
	public static function getAvailableValues()
	{
		$index = static::class;
		if (!isset(self::$availableValues[$index])) {
			$availableValues = self::getEnumConstants();
			static::checkAvailableValues($availableValues);
			self::$availableValues[$index] = $availableValues;
		}

		return self::$availableValues[$index];
	}

	/**
	 * @return mixed[] format: const name (string) => value (mixed)
	 */
	private static function getEnumConstants(): array
	{
		$classReflection = new ReflectionClass(static::class);
		$declaredConstants = ClassReflection::getDeclaredConstants($classReflection);
		ArrayType::removeKeys($declaredConstants, static::getIgnoredConstantNames());

		return $declaredConstants;
	}

	/**
	 * @return string[] names of constants which should not be used as valid values of this enum
	 */
	protected static function getIgnoredConstantNames(): array
	{
		return [];
	}

	/**
	 * @param mixed[] $availableValues
	 *
	 * @throws DuplicateValueSpecifiedException
	 * @throws InvalidArgumentTypeException
	 */
	protected static function checkAvailableValues(array $availableValues): void
	{
		$index = [];
		foreach ($availableValues as $value) {
			Type::checkType($value, 'int|string|float|bool|null');
			$key = self::getValueIndex($value);
			if (isset($index[$key])) {
				throw new DuplicateValueSpecifiedException($value, static::class);
			}
			$index[$key] = true;
		}
	}

	/**
	 * @param mixed $value
	 */
	private static function getValueIndex($value): string
	{
		$type = Type::getType($value);

		return $value . sprintf('[%s]', $type);
	}

	/**
	 * @return static[] format: const name (string) => instance (static)
	 * @throws DuplicateValueSpecifiedException
	 * @throws InvalidEnumValueException
	 * @throws InvalidArgumentTypeException
	 */
	public static function getAvailableEnums(): array
	{
		$values = static::getAvailableValues();

		return ArrayType::mapByCallback($values, fn(KeyValuePair $pair) => new KeyValuePair($pair->getKey(), static::get($pair->getValue())));
	}

	/**
	 * @param mixed $value
	 *
	 * @return static
	 * @throws InvalidEnumValueException
	 */
	public static function get($value): self
	{
		$index = sprintf('%s::%s', static::class, self::getValueIndex($value));
		if (!isset(self::$instances[$index])) {
			self::$instances[$index] = new static($value);
		}

		return self::$instances[$index];
	}

	/**
	 * @return mixed
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * @throws OperationSupportedOnlyForSameEnumException
	 */
	public function equals(self $that): bool
	{
		$this->checkSameEnum($that);

		return $this === $that;
	}

	/**
	 * @throws OperationSupportedOnlyForSameEnumException
	 */
	protected function checkSameEnum(self $that): void
	{
		if ($this::class !== $that::class) {
			throw new OperationSupportedOnlyForSameEnumException($that, $this);
		}
	}

	/**
	 * @param mixed $value
	 */
	public function equalsValue($value): bool
	{
		return $this->getValue() === $value;
	}
}
