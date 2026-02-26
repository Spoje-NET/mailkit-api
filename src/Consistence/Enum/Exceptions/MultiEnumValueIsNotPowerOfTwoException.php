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

class MultiEnumValueIsNotPowerOfTwoException extends PhpException
{
    private readonly int $value;
    private readonly string $class;

    public function __construct(int $value, string $class, ?\Throwable $previous = null)
    {
        parent::__construct(
            sprintf(
                'Value %d in %s is not a power of two, which is needed for MultiEnum to work as expected',
                $value,
                $class,
            ),
            $previous,
        );
        $this->value = $value;
        $this->class = $class;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getClass(): string
    {
        return $this->class;
    }
}
