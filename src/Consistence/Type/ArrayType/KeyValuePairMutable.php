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

namespace Igloonet\MailkitApi\Consistence\Type\ArrayType;

use Igloonet\MailkitApi\Consistence\Exceptions\InvalidArgumentTypeException;

class KeyValuePairMutable extends KeyValuePair
{
    /**
     * @param int|string $key
     * @param mixed      $value
     *
     * @throws InvalidArgumentTypeException
     */
    public function setPair($key, $value): void
    {
        parent::setPair($key, $value);
    }
}
