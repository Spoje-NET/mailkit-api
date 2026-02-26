<?php

declare(strict_types=1);

/**
 * This file is part of the MailkitApi package
 *
 * https://github.com/Vitexus/mailkit-api/
 *
 * (c) SpojeNet IT s.r.o. <https://spojenet.cz/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Igloonet\MailkitApi\RPC\Responses;

use Igloonet\MailkitApi\RPC\Exceptions\InvalidDataTypeException;

abstract class ErrorRpcResponse implements IRpcResponse
{
    protected ?int $errorCode = null;

    protected ?string $error = null;

    public function __construct(string $error, int $errorCode = 0)
    {
        $this->error = $error;
        $this->errorCode = $errorCode;
    }

    public function getStatus(): string
    {
        return self::STATUS_ERROR;
    }

    public function isError(): bool
    {
        return true;
    }

    public function getError(): ?string
    {
        return $this->error;
    }

    public function getErrorCode(): ?int
    {
        return $this->errorCode;
    }

    /**
     * @throws InvalidDataTypeException
     */
    public function getArrayValue(): array
    {
        throw new InvalidDataTypeException('Unable to get array value from error response');
    }

    /**
     * @throws InvalidDataTypeException
     */
    public function getStringValue(): string
    {
        throw new InvalidDataTypeException('Unable to get string value from error response');
    }

    /**
     * @throws InvalidDataTypeException
     */
    public function getIntegerValue(): int
    {
        throw new InvalidDataTypeException('Unable to get integer value from error response');
    }

    /**
     * @throws InvalidDataTypeException
     */
    public function getBooleanValue(): bool
    {
        throw new InvalidDataTypeException('Unable to get boolean value from error response');
    }

    /**
     * @throws InvalidDataTypeException
     */
    public function getArrayData(): array
    {
        throw new InvalidDataTypeException('Unable to extract array data from error response');
    }

    /**
     * @throws InvalidDataTypeException
     */
    public function getStringData(): string
    {
        throw new InvalidDataTypeException('Unable to extract string data from error response');
    }

    /**
     * @throws InvalidDataTypeException
     */
    public function getIntegerData(): int
    {
        throw new InvalidDataTypeException('Unable to extract integer data from error response');
    }

    /**
     * @throws InvalidDataTypeException
     */
    public function getBooleanData(): bool
    {
        throw new InvalidDataTypeException('Unable to extract boolean data from error response');
    }
}
