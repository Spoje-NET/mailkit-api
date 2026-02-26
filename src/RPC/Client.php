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

namespace Igloonet\MailkitApi\RPC;

use Igloonet\MailkitApi\RPC\Adapters\JsonAdapter;
use Igloonet\MailkitApi\RPC\Adapters\XmlAdapter;
use Igloonet\MailkitApi\RPC\Responses\IRpcResponse;

class Client
{
    private XmlAdapter $xmlAdapter = null;
    private JsonAdapter $jsonAdapter = null;

    public function __construct(string $clientId, string $clientMd5)
    {
        $this->xmlAdapter = new XmlAdapter($clientId, $clientMd5);
        $this->jsonAdapter = new JsonAdapter($clientId, $clientMd5);
    }

    public function sendRpcRequest(string $method, array $params, array $possibleErrors): IRpcResponse
    {
        // @todo finish when mailkit finished JSON support
        //		if ($this->jsonAdapter->supportsMethod($method)) {
        //			return $this->jsonAdapter->sendRequest($method, $params, $possibleErrors);
        //		}

        return $this->xmlAdapter->sendRequest($method, $params, $possibleErrors);
    }
}
