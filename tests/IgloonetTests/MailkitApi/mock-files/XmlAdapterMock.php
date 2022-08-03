<?php

namespace IgloonetTests\MailkitApi;

class XmlAdapterMock extends \Igloonet\MailkitApi\RPC\Adapters\XmlAdapter
{
	public function __construct()
	{
		parent::__construct('clientId', 'clientMd5');
	}

	/**
	 * @param mixed[] $requestData
	 * @param mixed[] $options
	 */
	protected function getContent(string $method, array $requestData, array $options): string|false
	{
		if (isset($requestData[2])) {
			return @file_get_contents(__DIR__ . '/api-data/xml/' . $method . '.' . $requestData[2] . '.xml');
		}

		return @file_get_contents(__DIR__ . '/api-data/xml/' . $method . '.xml');
	}
}
