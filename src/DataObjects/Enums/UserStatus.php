<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi\DataObjects\Enums;

use Igloonet\MailkitApi\Consistence\Enum\Enum;

class UserStatus extends Enum
{
	final const ENABLED = 'enabled';
	final const DISABLED = 'disabled';
	final const UNKNOWN = 'unknown';
	final const TEMPORARY = 'temporary';
	final const PERMANENT = 'permanent';
	final const UNSUBSCRIBE = 'unsubscribe';
}
