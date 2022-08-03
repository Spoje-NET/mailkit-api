<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi\RPC\Adapters;

use Igloonet\MailkitApi\RPC\Responses\IRpcResponse;

interface IAdapter
{
	/**
	 * @param string $method
	 * @param mixed[] $params
	 * @param mixed[] $possibleErrors
	 *
	 * @return IRpcResponse
	 */
	public function sendRequest(string $method, array $params, array $possibleErrors): IRpcResponse;

	/**
	 * @param string $method
	 *
	 * @return bool
	 */
	public function supportsMethod(string $method): bool;
}
