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

namespace Igloonet\MailkitApi\Consistence\Reflection;

use Igloonet\MailkitApi\Consistence\Exceptions\StaticClassException;
use Igloonet\MailkitApi\Consistence\ObjectPrototype;
use Igloonet\MailkitApi\Consistence\Type\ArrayType\ArrayType;
use ReflectionClass;

class ClassReflection extends ObjectPrototype
{
    final public const FILTER_VISIBILITY_NONE = -1;
    final public const CASE_SENSITIVE = true;
    final public const CASE_INSENSITIVE = false;

    final public function __construct()
    {
        throw new StaticClassException();
    }

    /**
     * Retrieves methods defined only at the same level as given ReflectionClass.
     *
     * @param int $filter
     *
     * @return \ReflectionMethod[]
     */
    public static function getDeclaredMethods(\ReflectionClass $classReflection, $filter = self::FILTER_VISIBILITY_NONE): array
    {
        $methods = $classReflection->getMethods($filter);
        $className = $classReflection->getName();

        return ArrayType::filterValuesByCallback($methods, static fn (\ReflectionMethod $method) => $method->class === $className);
    }

    /**
     * Is method of this name defined in this class?
     *
     * @param string $methodName
     * @param bool   $caseSensitive should the comparison be case-sensitive? (php methods are not by default, but you should)
     *
     * @return bool
     */
    public static function hasDeclaredMethod(
        \ReflectionClass $classReflection,
        $methodName,
        $caseSensitive = self::CASE_SENSITIVE,
    ) {
        try {
            $methodReflection = $classReflection->getMethod($methodName);

            return $methodReflection->class === $classReflection->getName()
                && (!$caseSensitive || $methodReflection->name === $methodName);
        } catch (\ReflectionException) {
            return false;
        }
    }

    /**
     * Retrieves properties defined only at the same level as given ReflectionClass.
     *
     * @param int $filter
     *
     * @return \ReflectionMethod[]
     */
    public static function getDeclaredProperties(\ReflectionClass $classReflection, $filter = self::FILTER_VISIBILITY_NONE)
    {
        $properties = $classReflection->getProperties($filter);
        $className = $classReflection->getName();

        return ArrayType::filterValuesByCallback($properties, static fn (\ReflectionProperty $property) => $property->class === $className);
    }

    /**
     * Is property of this name defined in this class?
     *
     * @param string $propertyName
     *
     * @return bool
     */
    public static function hasDeclaredProperty(\ReflectionClass $classReflection, $propertyName)
    {
        try {
            return $classReflection->getProperty($propertyName)->class === $classReflection->getName();
        } catch (\ReflectionException) {
            return false;
        }
    }

    /**
     * Is constant of this name defined in this class?
     *
     * WARNING: cannot detect redeclarations of the same constant
     *
     * @param string $constantName
     *
     * @return bool
     */
    public static function hasDeclaredConstant(\ReflectionClass $classReflection, $constantName)
    {
        return isset(static::getDeclaredConstants($classReflection)[$constantName]);
    }

    /**
     * Retrieves constants defined only at the same level as given ReflectionClass.
     *
     * WARNING: cannot detect redeclarations of the same constant
     *
     * @return string[] format: name(string) => value(mixed)
     */
    public static function getDeclaredConstants(\ReflectionClass $classReflection)
    {
        $constants = $classReflection->getConstants();
        $processClass = $classReflection;

        while (($processClass = $processClass->getParentClass()) !== false) {
            ArrayType::removeKeysByArrayKeys($constants, $processClass->getConstants());
        }

        return $constants;
    }
}
