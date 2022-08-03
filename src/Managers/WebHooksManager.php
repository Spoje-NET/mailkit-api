<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi\Managers;

use Igloonet\MailkitApi\Consistence\Enum\Exceptions\InvalidEnumValueException;
use Igloonet\MailkitApi\DataObjects\SubscribeWebHook;
use Igloonet\MailkitApi\DataObjects\UnsubscribeWebHook;
use Igloonet\MailkitApi\Helpers\Strict;
use Nette\Utils\Json;
use Nette\Utils\JsonException;

class WebHooksManager
{
	public function processSubscribe(string $content): ?SubscribeWebHook
	{
		try {
			$responseData = Strict::array(Json::decode($content, Json::FORCE_ARRAY));

			return SubscribeWebHook::fromArray($responseData);
		} catch (JsonException) {
		}

		return null;
	}

	/**
	 * @throws InvalidEnumValueException
	 */
	public function processUnsubscribe(string $content): ?UnsubscribeWebHook
	{
		try {
			$responseData = Strict::array(Json::decode($content, Json::FORCE_ARRAY));

			return UnsubscribeWebHook::fromArray($responseData);
		} catch (JsonException) {
		}

		return null;
	}
}
