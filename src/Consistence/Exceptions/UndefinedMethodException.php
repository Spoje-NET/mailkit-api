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

namespace Igloonet\MailkitApi\Consistence\Exceptions;

class UndefinedMethodException extends PhpException
{
    private readonly string $className;
    private readonly string $methodName;

    public function __construct(string $className, string $methodName, ?\Throwable $previous = null)
    {
        parent::__construct(sprintf('Method %s::%s() is not defined or is not accessible', $className, $methodName), $previous);
        $this->className = $className;
        $this->methodName = $methodName;
    }

    public function getClassName(): string
    {
        return $this->className;
    }

    public function getMethodName(): string
    {
        return $this->methodName;
    }
}
