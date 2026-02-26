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

namespace Igloonet\MailkitApi\Managers;

use Igloonet\MailkitApi\DataObjects\SubscribeWebHook;
use Igloonet\MailkitApi\DataObjects\UnsubscribeWebHook;
use Nette\Utils\Json;
use Nette\Utils\JsonException;

class WebHooksManager
{
    public function processSubscribe($content)
    {
        try {
            $responseData = Json::decode($content, Json::FORCE_ARRAY);

            return SubscribeWebHook::fromArray($responseData);
        } catch (JsonException $e) {
        }

        return null;
    }

    public function processUnsubscribe($content)
    {
        try {
            $responseData = Json::decode($content, Json::FORCE_ARRAY);

            return UnsubscribeWebHook::fromArray($responseData);
        } catch (JsonException $e) {
        }

        return null;
    }
}
