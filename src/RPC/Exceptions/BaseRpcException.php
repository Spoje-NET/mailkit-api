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

namespace Igloonet\MailkitApi\RPC\Exceptions;

abstract class BaseRpcException extends \RuntimeException implements RpcException
{
    protected string $method;
    protected mixed $requestData = null;

    public function __construct(
        string $method,
        array $requestData,
        string $message = '',
        int $code = 0,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);

        $this->method = $method;
        $this->requestData = $requestData;

        if (trim($this->message) === '') {
            $this->message = $this->getDefaultMessage();
        }
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getRequestData()
    {
        return $this->requestData;
    }

    abstract protected function getDefaultMessage(): string;
}
