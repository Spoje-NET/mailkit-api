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

class InvalidEnumValueException extends PhpException
{
    private mixed $value;

    /**
     * @var mixed[]
     */
    private readonly array $availableValues;

    /**
     * @param mixed   $value
     * @param mixed[] $availableValues
     */
    public function __construct($value, array $availableValues, ?\Throwable $previous = null)
    {
        parent::__construct(
            sprintf(
                '%s [%s] is not a valid value, accepted values: %s',
                $value,
                Type::getType($value),
                implode(', ', $availableValues),
            ),
            $previous,
        );
        $this->value = $value;
        $this->availableValues = $availableValues;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return mixed[]
     */
    public function getAvailableValues(): array
    {
        return $this->availableValues;
    }
}
