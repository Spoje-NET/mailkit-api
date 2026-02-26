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

namespace Igloonet\MailkitApi\Consistence\Enum\Exceptions;

use Igloonet\MailkitApi\Consistence\Exceptions\PhpException;
use Igloonet\MailkitApi\Consistence\Type\Type;

class DuplicateValueSpecifiedException extends PhpException
{
    private mixed $value;
    private readonly string $class;

    /**
     * @param mixed $value
     */
    public function __construct($value, string $class, ?\Throwable $previous = null)
    {
        parent::__construct(
            sprintf(
                'Value %s [%s] is specified in %s\'s available values multiple times',
                $value,
                Type::getType($value),
                $class,
            ),
            $previous,
        );
        $this->value = $value;
        $this->class = $class;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    public function getClass(): string
    {
        return $this->class;
    }
}
