<?php

declare(strict_types=1);

/**
 * This file is part of the MailkitApi package
 *
 * https://github.com/Spoje-NET/mailkit-api
 *
 * (c) SpojeNet IT s.r.o. <https://spojenet.cz/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

abstract class Enum extends ObjectPrototype
{
    /**
     * @var self[] indexed by enum and value
     */
    private static array $instances = [];

    /**
     * @var mixed[] format: enum name (string) => cached values (const name (string) => value (mixed))
     */
    private static array $availableValues;
    private mixed $value;

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
     * @throws DuplicateValueSpecifiedException
     *
     * @return mixed[] format: const name (string) => value (mixed)
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
     * @throws DuplicateValueSpecifiedException
     * @throws InvalidArgumentTypeException
     * @throws InvalidEnumValueException
     *
     * @return static[] format: const name (string) => instance (static)
     */
    public static function getAvailableEnums(): array
    {
        $values = static::getAvailableValues();

        return ArrayType::mapByCallback($values, static fn (KeyValuePair $pair) => new KeyValuePair($pair->getKey(), static::get($pair->getValue())));
    }

    /**
     * @param mixed $value
     *
     * @throws InvalidEnumValueException
     *
     * @return static
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
     * @param mixed $value
     */
    public function equalsValue($value): bool
    {
        return $this->getValue() === $value;
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
     * @throws OperationSupportedOnlyForSameEnumException
     */
    protected function checkSameEnum(self $that): void
    {
        if ($this::class !== $that::class) {
            throw new OperationSupportedOnlyForSameEnumException($that, $this);
        }
    }

    /**
     * @return mixed[] format: const name (string) => value (mixed)
     */
    private static function getEnumConstants(): array
    {
        $classReflection = new \ReflectionClass(static::class);
        $declaredConstants = ClassReflection::getDeclaredConstants($classReflection);
        ArrayType::removeKeys($declaredConstants, static::getIgnoredConstantNames());

        return $declaredConstants;
    }

    /**
     * @param mixed $value
     */
    private static function getValueIndex($value): string
    {
        $type = Type::getType($value);

        return $value.sprintf('[%s]', $type);
    }
}
