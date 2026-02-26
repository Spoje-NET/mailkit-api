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

abstract class SuccessRpcResponse implements IRpcResponse
{
    public function getStatus(): string
    {
        return self::STATUS_SUCCESS;
    }

    public function isError(): bool
    {
        return false;
    }

    public function getError(): ?string
    {
        return null;
    }

    public function getErrorCode(): ?int
    {
        return null;
    }
}
