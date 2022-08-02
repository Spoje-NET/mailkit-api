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
	public static function magicCall($object, string $name): void
	{
		Type::checkType($object, 'object');

		throw new UndefinedMethodException(get_class($object), $name);
	}

	/**
	 * Call to undefined static method
	 *
	 * @param string $class
	 * @param string $name method name
	 *
	 * @throws UndefinedMethodException
	 */
	public static function magicCallStatic(string $class, string $name): void
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
	public static function magicGet($object, string $name): void
	{
		Type::checkType($object, 'object');

		throw new UndefinedPropertyException(get_class($object), $name);
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
	public static function magicSet($object, string $name): void
	{
		Type::checkType($object, 'object');

		throw new UndefinedPropertyException(get_class($object), $name);
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
	public static function magicIsSet($object, string $name): void
	{
		Type::checkType($object, 'object');

		throw new UndefinedPropertyException(get_class($object), $name);
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
	public static function magicUnset($object, string $name): void
	{
		Type::checkType($object, 'object');

		throw new UndefinedPropertyException(get_class($object), $name);
	}

}
