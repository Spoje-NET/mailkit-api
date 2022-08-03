<?php

declare(strict_types = 1);

namespace Igloonet\MailkitApi\Consistence\Type;

use Igloonet\MailkitApi\Consistence\Exceptions\InvalidArgumentTypeException;
use Igloonet\MailkitApi\Consistence\Exceptions\UndefinedMethodException;
use Igloonet\MailkitApi\Consistence\Exceptions\UndefinedPropertyException;

trait ObjectMixinTrait
{
	/**
	 * Call to undefined static method
	 *
	 * @param string $name method name
	 * @param mixed[] $args method args
	 *
	 * @throws UndefinedMethodException
	 */
	public static function __callStatic(string $name, array $args): void
	{
		ObjectMixin::magicCallStatic(static::class, $name);
		// @codeCoverageIgnoreStart
		// return from this method is never invoked (always throws exception)
	}
	// @codeCoverageIgnoreEnd

	/**
	 * Call to undefined method
	 *
	 * @param string $name method name
	 * @param mixed[] $args method args
	 *
	 * @throws InvalidArgumentTypeException
	 * @throws UndefinedMethodException
	 */
	public function __call(string $name, array $args): void
	{
		ObjectMixin::magicCall($this, $name);
		// @codeCoverageIgnoreStart
		// return from this method is never invoked (always throws exception)
	}
	// @codeCoverageIgnoreEnd

	/**
	 * Access to undefined property
	 *
	 * @param string $name property name
	 *
	 * @throws InvalidArgumentTypeException
	 * @throws UndefinedPropertyException
	 */
	public function &__get(string $name): void
	{
		ObjectMixin::magicGet($this, $name);
		// @codeCoverageIgnoreStart
		// return from this method is never invoked (always throws exception)
	}
	// @codeCoverageIgnoreEnd

	/**
	 * Write to undefined property
	 *
	 * @param string $name property name
	 * @param mixed $value property value
	 *
	 * @throws InvalidArgumentTypeException
	 * @throws UndefinedPropertyException
	 */
	public function __set(string $name, $value): void
	{
		ObjectMixin::magicSet($this, $name);
		// @codeCoverageIgnoreStart
		// return from this method is never invoked (always throws exception)
	}
	// @codeCoverageIgnoreEnd

	/**
	 * Isset undefined property
	 *
	 * @param string $name property name
	 *
	 * @throws InvalidArgumentTypeException
	 * @throws UndefinedPropertyException
	 */
	public function __isset(string $name)
	{
		ObjectMixin::magicIsSet($this, $name);
		// @codeCoverageIgnoreStart
		// return from this method is never invoked (always throws exception)
	}
	// @codeCoverageIgnoreEnd

	/**
	 * Unset undefined property
	 *
	 * @param string $name property name
	 *
	 * @throws InvalidArgumentTypeException
	 * @throws UndefinedPropertyException
	 */
	public function __unset(string $name): void
	{
		ObjectMixin::magicUnset($this, $name);
		// @codeCoverageIgnoreStart
		// return from this method is never invoked (always throws exception)
	}
	// @codeCoverageIgnoreEnd

}
