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

class JsonSuccessRpcResponse extends SuccessRpcResponse
{
    protected ?array $data = null;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @throws InvalidDataTypeException
     */
    public function getArrayValue(): array
    {
        if ($this->data === null) {
            throw new InvalidDataTypeException('Unable to get array value from response');
        }

        return $this->data;
    }

    public function getStringValue(): string
    {
        throw new InvalidDataTypeException();
    }

    public function getIntegerValue(): int
    {
        throw new InvalidDataTypeException();
    }

    public function getBooleanValue(): bool
    {
        throw new InvalidDataTypeException();
    }

    public function getArrayData(): array
    {
        if (!isset($this->data['data']) || !\is_array($this->data['data'])) {
            throw new InvalidDataTypeException(sprintf(
                'Unable to extract array data from response %s',
                print_r($this->data, true),
            ));
        }

        return $this->data['data'];
    }

    /**
     * @throws InvalidDataTypeException
     */
    public function getStringData(): string
    {
        if (!isset($this->data['data']) || !\is_string($this->data['data'])) {
            throw new InvalidDataTypeException(sprintf(
                'Unable to extract string data from response %s',
                print_r($this->data, true),
            ));
        }

        return $this->data['data'];
    }

    /**
     * @throws InvalidDataTypeException
     */
    public function getIntegerData(): int
    {
        if (!isset($this->data['data']) || !\is_string($this->data['data'])) {
            throw new InvalidDataTypeException(sprintf(
                'Unable to extract integer data from response %s',
                print_r($this->data, true),
            ));
        }

        return (int) $this->data['data'];
    }

    /**
     * @throws InvalidDataTypeException
     */
    public function getBooleanData(): bool
    {
        if (!isset($this->data['data']) || !\is_bool($this->data['data'])) {
            throw new InvalidDataTypeException(sprintf(
                'Unable to extract boolean data from response %s',
                print_r($this->data, true),
            ));
        }

        return $this->data['data'];
    }
}
