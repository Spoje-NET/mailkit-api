<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi\Helpers;

use LogicException;

final class Strict
{
	/**
	 * @param mixed $var
	 */
	public static function string($var): string
	{
		if (!is_string($var)) {
			throw new LogicException();
		}

		return $var;
	}

	/**
	 * @param mixed $var
	 */
	public static function integer($var): int
	{
		if (!is_int($var)) {
			throw new LogicException();
		}

		return $var;
	}

	/**
	 * @param mixed $var
	 *
	 * @return mixed[]
	 */
	public static function array($var): array
	{
		if (!is_array($var)) {
			throw new LogicException();
		}

		return $var;
	}
}
