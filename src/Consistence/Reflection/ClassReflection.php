<?php

namespace Igloonet\MailkitApi\Consistence\Reflection;

use Igloonet\MailkitApi\Consistence\Exceptions\StaticClassException;
use Igloonet\MailkitApi\Consistence\ObjectPrototype;
use Igloonet\MailkitApi\Consistence\Type\ArrayType\ArrayType;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

class ClassReflection extends ObjectPrototype
{
	final const FILTER_VISIBILITY_NONE = -1;
	final const CASE_SENSITIVE = true;
	final const CASE_INSENSITIVE = false;

	final public function __construct()
	{
		throw new StaticClassException();
	}

	/**
	 * Retrieves methods defined only at the same level as given ReflectionClass
	 *
	 * @param integer $filter
	 *
	 * @return ReflectionMethod[]
	 */
	public static function getDeclaredMethods(ReflectionClass $classReflection, $filter = self::FILTER_VISIBILITY_NONE): array
	{
		$methods = $classReflection->getMethods($filter);
		$className = $classReflection->getName();

		return ArrayType::filterValuesByCallback($methods, fn(ReflectionMethod $method) => $method->class === $className);
	}

	/**
	 * Is method of this name defined in this class?
	 *
	 * @param string $methodName
	 * @param boolean $caseSensitive should the comparison be case-sensitive? (php methods are not by default, but you should)
	 *
	 * @return boolean
	 */
	public static function hasDeclaredMethod(
		ReflectionClass $classReflection,
		$methodName,
		$caseSensitive = self::CASE_SENSITIVE
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
	 * Retrieves properties defined only at the same level as given ReflectionClass
	 *
	 * @param integer $filter
	 *
	 * @return ReflectionMethod[]
	 */
	public static function getDeclaredProperties(ReflectionClass $classReflection, $filter = self::FILTER_VISIBILITY_NONE)
	{
		$properties = $classReflection->getProperties($filter);
		$className = $classReflection->getName();

		return ArrayType::filterValuesByCallback($properties, fn(ReflectionProperty $property) => $property->class === $className);
	}

	/**
	 * Is property of this name defined in this class?
	 *
	 * @param string $propertyName
	 *
	 * @return boolean
	 */
	public static function hasDeclaredProperty(ReflectionClass $classReflection, $propertyName)
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
	 * @param ReflectionClass $classReflection
	 * @param string $constantName
	 *
	 * @return boolean
	 */
	public static function hasDeclaredConstant(ReflectionClass $classReflection, $constantName)
	{
		return isset(static::getDeclaredConstants($classReflection)[$constantName]);
	}

	/**
	 * Retrieves constants defined only at the same level as given ReflectionClass
	 *
	 * WARNING: cannot detect redeclarations of the same constant
	 *
	 * @param ReflectionClass $classReflection
	 *
	 * @return string[] format: name(string) => value(mixed)
	 */
	public static function getDeclaredConstants(ReflectionClass $classReflection)
	{
		$constants = $classReflection->getConstants();
		$processClass = $classReflection;
		while (($processClass = $processClass->getParentClass()) !== false) {
			ArrayType::removeKeysByArrayKeys($constants, $processClass->getConstants());
		}

		return $constants;
	}
}
