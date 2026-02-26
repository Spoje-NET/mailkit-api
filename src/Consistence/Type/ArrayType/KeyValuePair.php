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
use Igloonet\MailkitApi\Consistence\ObjectPrototype;
use Igloonet\MailkitApi\Consistence\Type\Type;

class KeyValuePair extends ObjectPrototype
{
    private int|string $key;
    private mixed $value;

    /**
     * @param int|string $key
     * @param mixed      $value
     *
     * @throws InvalidArgumentTypeException
     */
    public function __construct($key, $value)
    {
        $this->setPair($key, $value);
    }

    /**
     * @return int|string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param int|string $key
     * @param mixed      $value
     *
     * @throws InvalidArgumentTypeException
     */
    protected function setPair($key, $value): void
    {
        Type::checkType($key, 'int|string');
        $this->key = $key;
        $this->value = $value;
    }
}
