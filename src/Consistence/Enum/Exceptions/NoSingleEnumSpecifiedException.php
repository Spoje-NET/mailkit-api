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

use Igloonet\MailkitApi\Consistence\Enum\Enum;
use Igloonet\MailkitApi\Consistence\Exceptions\PhpException;

class NoSingleEnumSpecifiedException extends PhpException
{
    private readonly string $class;

    public function __construct(string $class, ?\Throwable $previous = null)
    {
        parent::__construct(
            sprintf(
                'There is no single Enum (implementing %s) defined for MultiEnum %s',
                Enum::class,
                $class,
            ),
            $previous,
        );
        $this->class = $class;
    }

    public function getClass(): string
    {
        return $this->class;
    }
}
