<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi\DataObjects\Enums;

use Igloonet\MailkitApi\Consistence\Enum\Enum;

class InsertStatus extends Enum
{
	final const UPDATE = 0;
	final const INSERT = 1;
	final const INSERT_UNSUBSCRIBE = 2;
	final const UPDATE_UNSUBSCRIBE = 3;
	final const FAULT = 4;
}
