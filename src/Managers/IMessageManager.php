<?php

declare(strict_types=1);

/**
 * This file is part of the MailkitApi package
 *
 * https://github.com/Vitexus/mailkit-api/
 *
 * (c) SpojeNet IT s.r.o. <https://spojenet.cz/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Igloonet\MailkitApi\Managers;

use Igloonet\MailkitApi\DataObjects\Message;
use Igloonet\MailkitApi\Results\SendMailResult;

interface IMessageManager
{
    public function sendMail(
        Message $message,
        ?int $mailingListId,
        int $campaignId,
    ): SendMailResult;
}
