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

namespace Igloonet\MailkitApi\RPC\Responses;

interface IRpcResponse
{
    public const STATUS_SUCCESS = 'success';
    public const STATUS_ERROR = 'error';

    public function getStatus(): string;

    public function isError(): bool;

    public function getErrorCode(): ?int;

    public function getError(): ?string;

    public function getArrayValue(): array;

    public function getStringValue(): string;

    public function getIntegerValue(): int;

    public function getBooleanValue(): bool;

    public function getArrayData(): array;

    public function getStringData(): string;

    public function getIntegerData(): int;

    public function getBooleanData(): bool;
}
