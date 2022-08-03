<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi\RPC;

use Igloonet\MailkitApi\RPC\Adapters\JsonAdapter;
use Igloonet\MailkitApi\RPC\Adapters\XmlAdapter;
use Igloonet\MailkitApi\RPC\Responses\IRpcResponse;

class Client
{
	private ?\Igloonet\MailkitApi\RPC\Adapters\XmlAdapter $xmlAdapter = null;

	private ?\Igloonet\MailkitApi\RPC\Adapters\JsonAdapter $jsonAdapter = null;

	public function __construct(string $clientId, string $clientMd5)
	{
		$this->xmlAdapter = new XmlAdapter($clientId, $clientMd5);
		$this->jsonAdapter = new JsonAdapter($clientId, $clientMd5);
	}

	/**
	 * @param mixed[] $params
	 * @param mixed[] $possibleErrors
	 */
	public function sendRpcRequest(string $method, array $params, array $possibleErrors): IRpcResponse
	{
		//@todo finish when mailkit finished JSON support
//		if ($this->jsonAdapter->supportsMethod($method)) {
//			return $this->jsonAdapter->sendRequest($method, $params, $possibleErrors);
//		}

		return $this->xmlAdapter->sendRequest($method, $params, $possibleErrors);
	}
}
