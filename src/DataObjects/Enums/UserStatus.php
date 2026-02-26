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

enum UserStatus: string
{
    case ENABLED = 'enabled';
    case DISABLED = 'disabled';
    case UNKNOWN = 'unknown';
    case TEMPORARY = 'temporary';
    case PERMANENT = 'permanent';
    case UNSUBSCRIBE = 'unsubscribe';
}
