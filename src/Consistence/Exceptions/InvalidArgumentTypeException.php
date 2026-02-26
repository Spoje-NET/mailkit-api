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

use Igloonet\MailkitApi\Consistence\Type\Type;

class InvalidArgumentTypeException extends InvalidArgumentException
{
    private readonly string $valueType;

    /**
     * @param mixed $value
     */
    public function __construct(
        private $value,
        private readonly string $expectedTypes,
        ?\Throwable $previous = null,
    ) {
        $this->valueType = Type::getType($value);
        parent::__construct(
            sprintf('%s expected, %s [%s] given', $this->expectedTypes, self::getPrintedValue($value), $this->valueType),
            $previous,
        );
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    public function getValueType(): string
    {
        return $this->valueType;
    }

    public function getExpectedTypes(): string
    {
        return $this->expectedTypes;
    }

    /**
     * @param mixed $value
     */
    private static function getPrintedValue($value): string
    {
        $printedValue = $value;

        if (\is_object($value) && method_exists($value, '__toString') === false) {
            return $value::class.self::getObjectHash($value);
        }

        if (\is_array($value)) {
            return '';
        }

        return (string) $printedValue;
    }

    /**
     * @param object $value
     */
    private static function getObjectHash($value): string
    {
        return '#'.substr(md5(spl_object_hash($value)), 0, 4);
    }
}
