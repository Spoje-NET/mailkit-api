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

class InvalidResponseException extends \RuntimeException implements MailkitApiException
{
    private ?IRpcResponse $response = null;

    public function __construct(IRpcResponse $response, string $message = '', int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->response = $response;
    }
}
