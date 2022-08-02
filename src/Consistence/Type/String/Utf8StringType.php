<?php

declare(strict_types = 1);

namespace Igloonet\MailkitApi\Consistence\Type\String;

use Igloonet\MailkitApi\Consistence\Exceptions\StaticClassException;
use Igloonet\MailkitApi\Consistence\ObjectPrototype;

class Utf8StringType extends ObjectPrototype
{
	/**
	 * @throws StaticClassException
	 */
	final public function __construct()
	{
		throw new StaticClassException();
	}

	public static function length(string $string): int
	{
		return strlen(utf8_decode($string));
	}

}
