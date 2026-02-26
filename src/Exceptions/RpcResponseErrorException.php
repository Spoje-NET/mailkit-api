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

namespace Igloonet\MailkitApi\Exceptions;

use Igloonet\MailkitApi\RPC\Responses\IRpcResponse;

abstract class RpcResponseErrorException extends \RuntimeException implements MailkitApiException
{
    private IRpcResponse $rpcResponse = null;

    public function __construct(
        IRpcResponse $rpcResponse,
        string $message = '',
        int $code = 0,
        ?\Throwable $previous = null,
    ) {
        $this->rpcResponse = $rpcResponse;

        if (trim($message) === '') {
            $message = $rpcResponse->getError();
            $code = $rpcResponse->getErrorCode();
        }

        parent::__construct($message, $code, $previous);
    }

    public function getRpcResponse(): ?IRpcResponse
    {
        return $this->rpcResponse;
    }
}
