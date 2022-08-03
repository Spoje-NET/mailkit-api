<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi\Results;

use Igloonet\MailkitApi\DataObjects\Enums\SendMailResultStatus;
use Igloonet\MailkitApi\Exceptions\InvalidResponseException;
use Igloonet\MailkitApi\RPC\Responses\IRpcResponse;

final class SendMailResult implements IApiMethodResult
{
	public function __construct(
		private readonly ?int $emailId,
		private readonly ?int $sendingId,
		private readonly ?int $messageId,
		private readonly ?\Igloonet\MailkitApi\DataObjects\Enums\SendMailResultStatus $status
	) {
	}

	public static function fromRpcResponse(IRpcResponse $rpcResponse): self
	{
		$value = $rpcResponse->getArrayValue();

		foreach (['data', 'data2', 'data3', 'status'] as $field) {
			if (!array_key_exists($field, $value)) {
				throw new InvalidResponseException($rpcResponse, sprintf('Missing %s in RPC response!', $field));
			}
		}

		$emailId = is_numeric($value['data']) && (int) $value['data'] > 0 ? (int) $value['data'] : null;
		$sendingId = is_numeric($value['data2']) && (int) $value['data2'] > 0 ? (int) $value['data2'] : null;
		$messageId = is_numeric($value['data3']) && (int) $value['data3'] > 0 ? (int) $value['data3'] : null;
		$status = is_numeric($value['status']) ? SendMailResultStatus::get($value['status']) : null;

		return new self($emailId, $sendingId, $messageId, $status);
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
}
