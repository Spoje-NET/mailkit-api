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

enum SendMailResultStatus: int
{
    case UPDATE = 0;
    case INSERT = 1;
    case INSERT_UNSUBSCRIBE = 2;
    case UPDATE_UNSUBSCRIBE = 3;
    case FAULT = 4;
    case UPDATE_NOT_SENT = 6;
    case INSERT_NOT_SENT = 7;
}
