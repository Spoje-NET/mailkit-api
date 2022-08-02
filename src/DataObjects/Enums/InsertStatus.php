<?php
declare(strict_types=1);

namespace Igloonet\MailkitApi\DataObjects\Enums;

use Igloonet\MailkitApi\Consistence\Enum\Enum;

class InsertStatus extends Enum
{
	const UPDATE = 0;
	const INSERT = 1;
	const INSERT_UNSUBSCRIBE = 2;
	const UPDATE_UNSUBSCRIBE = 3;
	const FAULT = 4;
}
