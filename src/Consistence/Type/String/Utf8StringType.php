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
        return \strlen(utf8_decode($string));
    }
}
