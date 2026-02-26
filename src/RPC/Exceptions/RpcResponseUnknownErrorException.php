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

namespace Igloonet\MailkitApi\RPC\Exceptions;

class RpcResponseUnknownErrorException extends BaseRpcException
{
    protected string $error = '';

    protected array $possibleErrors = [];

    public function __construct(
        string $method,
        array $requestData,
        string $error,
        array $possibleErrors,
        string $message = '',
        int $code = 0,
        ?\Throwable $previous = null,
    ) {
        $this->error = $error;
        $this->possibleErrors = $possibleErrors;

        parent::__construct($method, $requestData, $message, $code, $previous);
    }

    protected function getDefaultMessage(): string
    {
        return sprintf(
            'Unknown RPC error returned: %s. Possible errors: %s',
            $this->error,
            implode(',', $this->possibleErrors),
        );
    }
}
