<?php
declare(strict_types=1);

namespace Igloonet\MailkitApi\DataObjects\Enums;

use Igloonet\MailkitApi\Consistence\Enum\Enum;

class UserStatus extends Enum
{
	const ENABLED = 'enabled';
	const DISABLED = 'disabled';
	const UNKNOWN = 'unknown';
	const TEMPORARY = 'temporary';
	const PERMANENT = 'permanent';
	const UNSUBSCRIBE = 'unsubscribe';
}
