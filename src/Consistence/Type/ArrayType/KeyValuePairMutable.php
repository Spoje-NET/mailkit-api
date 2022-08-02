<?php

declare(strict_types = 1);

namespace Igloonet\MailkitApi\Consistence\Type\ArrayType;

use Igloonet\MailkitApi\Consistence\Exceptions\InvalidArgumentTypeException;

class KeyValuePairMutable extends KeyValuePair
{
	/**
	 * @param int|string $key
	 * @param mixed $value
	 *
	 * @throws InvalidArgumentTypeException
	 */
	public function setPair($key, $value): void
	{
		parent::setPair($key, $value);
	}

}
