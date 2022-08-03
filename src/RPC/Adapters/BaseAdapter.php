<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi\RPC\Adapters;

abstract class BaseAdapter implements IAdapter
{
	public function __construct(protected string $clientId, protected string $clientMd5)
	{
	}
}
