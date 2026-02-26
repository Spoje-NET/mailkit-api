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

abstract class BaseRpcResponseException extends BaseRpcException
{
    private mixed $responseData = null;

    public function __construct(
        string $method,
        array $requestData,
        array $responseData,
        string $message = '',
        int $code = 0,
        ?\Throwable $previous = null,
    ) {
        $this->responseData = $responseData;

        parent::__construct($method, $requestData, $message, $code, $previous);
    }

    /**
     * @return mixed
     */
    public function getResponseData()
    {
        return $this->responseData;
    }
}
