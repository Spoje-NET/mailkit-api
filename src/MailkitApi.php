<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi;

use Igloonet\MailkitApi\Managers\MailingListsManager;
use Igloonet\MailkitApi\Managers\MessagesManager;
use Igloonet\MailkitApi\Managers\UsersManager;
use Igloonet\MailkitApi\Managers\WebHooksManager;

class MailkitApi
{
	public function __construct(
		private readonly MailingListsManager $mailingListsManager,
		private readonly UsersManager $usersManager,
		private readonly MessagesManager $messagesManager,
		private readonly WebHooksManager $webHooksManager
	) {
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
