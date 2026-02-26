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

namespace Igloonet\MailkitApi\Consistence\Type;

use Igloonet\MailkitApi\Consistence\Exceptions\InvalidArgumentTypeException;
use Igloonet\MailkitApi\Consistence\Exceptions\StaticClassException;
use Igloonet\MailkitApi\Consistence\ObjectPrototype;
use Traversable;

class Type extends ObjectPrototype
{
    final public const SEPARATOR_KEY_TYPE = ':';
    final public const SUBTYPES_ALLOW = true;
    final public const SUBTYPES_DISALLOW = false;
    final public const TYPE_MIXED = 'mixed';
    final public const TYPE_OBJECT = 'object';

    final public function __construct()
    {
        throw new StaticClassException();
    }

    /**
     * Checks if the $value has one of expected types, throws exception if not.
     *
     * @param mixed $value
     * @param bool  $allowSubtypes decides if subtypes of given expected types should be considered a valid value
     *
     * @throws InvalidArgumentTypeException
     *
     * @see hasType for syntax rules
     */
    public static function checkType($value, string $expectedTypes, bool $allowSubtypes = self::SUBTYPES_ALLOW): void
    {
        if (!self::hasType($value, $expectedTypes, $allowSubtypes)) {
            throw new InvalidArgumentTypeException($value, $expectedTypes);
        }
    }

    /**
     * Tests if the $value has one of expected types.
     *
     * Supported syntax:
     *  - int
     *  - mixed (allow every type)
     *  - object
     *  - integer
     *  - int|string
     *  - int|string|float
     *  - int|null
     *  - DateTime (do not use leading \)
     *  - stdClass|DateTime
     *  - int|DateTime
     *  - int[]
     *  - int[]|string[]
     *  - int[]|DateTime
     *  - int[][]
     *  - mixed[]|Collection
     *
     * Optional validation of keys in traversable types:
     *  - int:string[]
     *  - missing keys can be omitted on right - string:mixed:string[][] is the same as string:string[][]
     *  - key types cannot contain | sign to separate more accepted types
     *
     * @param mixed $value
     * @param bool  $allowSubtypes decides if subtypes of given expected types should be considered a valid value
     */
    public static function hasType($value, string $expectedTypes, bool $allowSubtypes = self::SUBTYPES_ALLOW): bool
    {
        $types = explode('|', $expectedTypes);

        foreach ($types as $type) {
            $typeLength = \strlen($type);

            if ($type[$typeLength - 1] === ']' && $type[$typeLength - 2] === '[') {
                if (!\is_array($value) && !($value instanceof \Traversable)) {
                    continue; // skip to next type
                }

                $itemsType = substr($type, 0, $typeLength - 2);
                $firstKeyTypeSeparatorPosition = strpos($itemsType, self::SEPARATOR_KEY_TYPE);

                if ($firstKeyTypeSeparatorPosition !== false) {
                    $keysType = substr($itemsType, 0, $firstKeyTypeSeparatorPosition);
                    $itemsType = substr($itemsType, $firstKeyTypeSeparatorPosition + 1);
                }

                foreach ($value as $key => $item) {
                    if (!self::hasType($item, $itemsType) || (isset($keysType) && !self::hasType($key, $keysType))) {
                        continue 2; // skip to next type
                    }
                }

                return true;
            }

            $type = self::normalizeType($type);

            if (
                $type === self::TYPE_MIXED
                || ($type === self::TYPE_OBJECT && \is_object($value))
                || strcasecmp(self::getType($value), $type) === 0
                || ($allowSubtypes && is_a($value, $type))
            ) {
                return true;
            }
        }

        return false;
    }

    /**
     * Returns type of given value, in case of objects returns class name, normalizes all scalar values to lowercase.
     *
     * @param mixed $value
     */
    public static function getType($value): string
    {
        if (\is_object($value)) {
            return $value::class;
        }

        $type = \gettype($value);

        return self::normalizeType($type);
    }

    private static function normalizeType(string $type): string
    {
        return match ($type) {
            'double' => 'float',
            'integer' => 'int',
            'boolean' => 'bool',
            'NULL' => 'null',
            default => $type,
        };
    }
}
