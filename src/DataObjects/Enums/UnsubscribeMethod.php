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

namespace Igloonet\MailkitApi\DataObjects\Enums;

enum UnsubscribeMethod: string
{
    case LINK_IN_MAIL = 'link_in_mail';
    case MANUAL = 'manual';
    case SPAM_REPORT = 'spam_report';
    case LIST_UNSUBSCRIBE_MAIL = 'list-unsubscribe_mail';
    case API_UNSUBSCRIBE = 'api_unsubscribe';
    case LIST_UNSUBSCRIBE_ONECLICK = 'list-unsubscribe_oneclick';
    case TIMEOUT = 'timeout';
}
