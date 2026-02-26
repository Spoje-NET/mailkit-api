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

namespace Igloonet\MailkitApi\Helpers;

final class Strict
{
    /**
     * @param mixed $var
     */
    public static function string($var): string
    {
        if (!\is_string($var)) {
            throw new \LogicException();
        }

        return $var;
    }

    /**
     * @param mixed $var
     */
    public static function integer($var): int
    {
        if (!\is_int($var)) {
            throw new \LogicException();
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
        if (!\is_array($var)) {
            throw new \LogicException();
        }

        return $var;
    }
}
