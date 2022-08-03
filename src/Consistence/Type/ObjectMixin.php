<?php

declare(strict_types = 1);

namespace Igloonet\MailkitApi\Consistence\Type;

use Igloonet\MailkitApi\Consistence\Exceptions\InvalidArgumentTypeException;
use Igloonet\MailkitApi\Consistence\Exceptions\StaticClassException;
use Igloonet\MailkitApi\Consistence\Exceptions\UndefinedMethodException;
use Igloonet\MailkitApi\Consistence\Exceptions\UndefinedPropertyException;

class ObjectMixin
{
	/**
	 * @throws StaticClassException
	 */
	final public function __construct()
	{
		throw new StaticClassException();
	}

	/**
	 * Call to undefined method
	 *
	 * @param object $object
	 * @param string $name method name
	 *
	 * @throws UndefinedMethodException
	 * @throws InvalidArgumentTypeException
	 */
	public static function magicCall($object, string $name): never
	{
		Type::checkType($object, 'object');

		throw new UndefinedMethodException($object::class, $name);
	}

	/**
	 * Call to undefined static method
	 *
	 * @param string $name method name
	 *
	 * @throws UndefinedMethodException
	 */
	public static function magicCallStatic(string $class, string $name): never
	{
		throw new UndefinedMethodException($class, $name);
	}

	/**
	 * Access to undefined property
	 *
	 * @param object $object
	 * @param string $name property name
	 *
	 * @throws UndefinedPropertyException
	 * @throws InvalidArgumentTypeException
	 */
	public static function magicGet($object, string $name): never
	{
		Type::checkType($object, 'object');

		throw new UndefinedPropertyException($object::class, $name);
	}

	/**
	 * Write to undefined property
	 *
	 * @param object $object
	 * @param string $name property name
	 *
	 * @throws UndefinedPropertyException
	 * @throws InvalidArgumentTypeException
	 */
	public static function magicSet($object, string $name): never
	{
		Type::checkType($object, 'object');

		throw new UndefinedPropertyException($object::class, $name);
	}

	/**
	 * Isset undefined property
	 *
	 * @param object $object
	 * @param string $name property name
	 *
	 * @throws UndefinedPropertyException
	 * @throws InvalidArgumentTypeException
	 */
	public static function magicIsSet($object, string $name): never
	{
		Type::checkType($object, 'object');

		throw new UndefinedPropertyException($object::class, $name);
	}

	/**
	 * Unset undefined property
	 *
	 * @param object $object
	 * @param string $name property name
	 *
	 * @throws UndefinedPropertyException
	 * @throws InvalidArgumentTypeException
	 */
	public static function magicUnset($object, string $name): never
	{
		Type::checkType($object, 'object');

		throw new UndefinedPropertyException($object::class, $name);
	}
}
