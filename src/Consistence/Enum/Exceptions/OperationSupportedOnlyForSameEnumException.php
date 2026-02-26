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

class OperationSupportedOnlyForSameEnumException extends PhpException
{
    private readonly \Igloonet\MailkitApi\Consistence\Enum\Enum $given;
    private readonly \Igloonet\MailkitApi\Consistence\Enum\Enum $expected;

    public function __construct(Enum $given, Enum $expected, ?\Throwable $previous = null)
    {
        parent::__construct(
            sprintf(
                'Operation supported only for enum of same class: %s given, %s expected',
                $given::class,
                $expected::class,
            ),
            $previous,
        );
        $this->given = $given;
        $this->expected = $expected;
    }

    public function getGiven(): Enum
    {
        return $this->given;
    }

    public function getExpected(): Enum
    {
        return $this->expected;
    }
}
