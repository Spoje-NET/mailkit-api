<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi\DataObjects\Enums;

use Igloonet\MailkitApi\Consistence\Enum\Enum;

class MailingListStatus extends Enum
{
	final const STATUS_ENABLED = 'enabled';
	final const STATUS_DISABLED = 'disabled';
}
