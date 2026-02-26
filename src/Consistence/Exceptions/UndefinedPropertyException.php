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

class UndefinedPropertyException extends PhpException
{
    private readonly string $className;
    private readonly string $propertyName;

    public function __construct(string $className, string $propertyName, ?\Throwable $previous = null)
    {
        parent::__construct(sprintf('Property %s::$%s is not defined or is not accessible', $className, $propertyName), $previous);
        $this->className = $className;
        $this->propertyName = $propertyName;
    }

    public function getClassName(): string
    {
        return $this->className;
    }

    public function getPropertyName(): string
    {
        return $this->propertyName;
    }
}
