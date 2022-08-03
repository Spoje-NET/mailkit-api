<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi\DataObjects\Enums;

use Igloonet\MailkitApi\Consistence\Enum\Enum;

class UnsubscribeMethod extends Enum
{
	final const LINK_IN_MAIL = 'link_in_mail';
	final const MANUAL = 'manual';
	final const SPAM_REPORT = 'spam_report';
	final const LIST_UNSUBSCRIBE_MAIL = 'list-unsubscribe_mail';
	final const API_UNSUBSCRIBE = 'api_unsubscribe';
	final const LIST_UNSUBSCRIBE_ONECLICK = 'list-unsubscribe_oneclick';
	final const TIMEOUT = 'timeout';
}
