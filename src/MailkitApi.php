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

namespace Igloonet\MailkitApi;

use Igloonet\MailkitApi\Managers\MailingListsManager;
use Igloonet\MailkitApi\Managers\MessagesManager;
use Igloonet\MailkitApi\Managers\UsersManager;
use Igloonet\MailkitApi\Managers\WebHooksManager;

class MailkitApi
{
    private MailingListsManager $mailingListsManager;
    private UsersManager $usersManager;
    private MessagesManager $messagesManager;
    private WebHooksManager $webHooksManager;

    public function __construct(
        MailingListsManager $mailingListsManager,
        UsersManager $usersManager,
        MessagesManager $messagesManager,
        WebHooksManager $webHooksManager,
    ) {
        $this->mailingListsManager = $mailingListsManager;
        $this->usersManager = $usersManager;
        $this->messagesManager = $messagesManager;
        $this->webHooksManager = $webHooksManager;
    }

    public function getMailingListsManager(): MailingListsManager
    {
        return $this->mailingListsManager;
    }

    public function getUsersManager(): UsersManager
    {
        return $this->usersManager;
    }

    public function getMessagesManager(): MessagesManager
    {
        return $this->messagesManager;
    }

    public function getWebHooksManager(): WebHooksManager
    {
        return $this->webHooksManager;
    }
}
