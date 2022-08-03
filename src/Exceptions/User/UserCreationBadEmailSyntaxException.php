<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi\Exceptions\User;

use Igloonet\MailkitApi\RPC\Responses\IRpcResponse;
use Throwable;

class UserCreationBadEmailSyntaxException extends UserCreationException
{
	public function __construct(
		IRpcResponse $rpcResponse,
		private readonly ?string $emailAddress,
		?string $message = '',
		int $code = 0,
		Throwable $previous = null
	) {
		parent::__construct($rpcResponse, (string) $message, $code, $previous);
	}
}
