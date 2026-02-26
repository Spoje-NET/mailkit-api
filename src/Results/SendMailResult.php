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

namespace Igloonet\MailkitApi\Results;

use Igloonet\MailkitApi\DataObjects\Enums\SendMailResultStatus;
use Igloonet\MailkitApi\Exceptions\InvalidResponseException;
use Igloonet\MailkitApi\RPC\Responses\IRpcResponse;

class SendMailResult implements IApiMethodResult
{
    private ?int $emailId = null;
    private ?int $sendingId = null;
    private ?int $messageId = null;
    private ?SendMailResultStatus $status = null;

    public function __construct(?int $emailId, ?int $sendingId, ?int $messageId, ?SendMailResultStatus $status)
    {
        $this->emailId = $emailId;
        $this->sendingId = $sendingId;
        $this->messageId = $messageId;
        $this->status = $status;
    }

    public function getEmailId(): ?int
    {
        return $this->emailId;
    }

    public function getSendingId(): ?int
    {
        return $this->sendingId;
    }

    public function getMessageId(): ?int
    {
        return $this->messageId;
    }

    public function getStatus(): ?SendMailResultStatus
    {
        return $this->status;
    }

    public static function fromRpcResponse(IRpcResponse $rpcResponse): self
    {
        $value = $rpcResponse->getArrayValue();

        foreach (['data', 'data2', 'data3', 'status'] as $field) {
            if (!\array_key_exists($field, $value)) {
                throw new InvalidResponseException($rpcResponse, sprintf('Missing %s in RPC response!', $field));
            }
        }

        $emailId = is_numeric($value['data']) && (int) $value['data'] > 0 ? (int) $value['data'] : null;
        $sendingId = is_numeric($value['data2']) && (int) $value['data2'] > 0 ? (int) $value['data2'] : null;
        $messageId = is_numeric($value['data3']) && (int) $value['data3'] > 0 ? (int) $value['data3'] : null;
        $status = is_numeric($value['status']) ? SendMailResultStatus::from((int) $value['status']) : null;

        return new static($emailId, $sendingId, $messageId, $status);
    }
}
