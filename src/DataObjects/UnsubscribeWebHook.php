<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi\DataObjects;

use Igloonet\MailkitApi\Consistence\Enum\Exceptions\InvalidEnumValueException;
use Igloonet\MailkitApi\DataObjects\Enums\UnsubscribeMethod;
use Nette\Utils\DateTime;

final class UnsubscribeWebHook
{
	private ?string $emailId = null;

	private ?\Nette\Utils\DateTime $date = null;

	private ?string $ip = null;

	private ?string $ipOrig = null;

	private ?string $mailingListId = null;

	private ?string $sendId = null;

	private ?string $messageId = null;

	private ?string $topicActiveId = null;

	private ?string $topicInactiveId = null;

	private ?string $timeout = null;

	private ?\Nette\Utils\DateTime $expire = null;

	private ?\Igloonet\MailkitApi\DataObjects\Enums\UnsubscribeMethod $method = null;

	private ?string $unsubscribeAnswer = null;

	private ?string $unsubscribeNote = null;

	/**
	 * @param mixed[] $jsonContent
	 * @param User $user
	 */
	private function __construct(private readonly array $jsonContent, private ?\Igloonet\MailkitApi\DataObjects\User $user)
	{
	}

	/**
	 * @param mixed[] $jsonContent
	 *
	 * @throws InvalidEnumValueException
	 */
	public static function fromArray(array $jsonContent): self
	{
		//validation

		$user = self::createUser($jsonContent);
		$subscribe = new self($jsonContent, $user);

		$subscribe->user = $user;
		$subscribe->emailId = self::validateEmptyString($jsonContent['ID_EMAIL']);
		$subscribe->date = new DateTime($jsonContent['DATE']);
		$subscribe->ip = self::validateIp($jsonContent['IP']);
		$subscribe->ipOrig = self::validateIp($jsonContent['IP_ORIG']);
		$subscribe->mailingListId = self::validateEmptyString($jsonContent['ID_ML']);
		$subscribe->sendId = self::validateEmptyString($jsonContent['ID_SEND']);
		$subscribe->messageId = self::validateEmptyString($jsonContent['ID_MESSAGE']);
		$subscribe->topicActiveId = self::validateEmptyString($jsonContent['ID_TOPIC_ACTIVE']);
		$subscribe->topicInactiveId = self::validateEmptyString($jsonContent['ID_TOPIC_INACTIVE']);
		$subscribe->timeout = self::validateEmptyString($jsonContent['TIMEOUT']);
		$subscribe->expire = new DateTime($jsonContent['EXPIRE']);
		$subscribe->method = UnsubscribeMethod::get($jsonContent['METHOD']);
		$subscribe->unsubscribeAnswer = self::validateEmptyString($jsonContent['UNSUBSCRIBE_ANSWER']);
		$subscribe->unsubscribeNote = self::validateEmptyString($jsonContent['UNSUBSCRIBE_NOTE']);

		return $subscribe;
	}

	/**
	 * @param mixed[] $jsonContent
	 */
	private static function createUser(array $jsonContent): User
	{
		return new User($jsonContent['EMAIL']);
	}

	private static function validateEmptyString(?string $string): ?string
	{
		$string ??= '';

		return trim($string) === '' ? null : trim($string);
	}

	private static function validateIp(?string $ipAddress): ?string
	{
		if (filter_var($ipAddress, FILTER_VALIDATE_IP)) {
			return $ipAddress;
		}

		return null;
	}

	public function getUser(): ?User
	{
		return $this->user;
	}

	public function getEmailId(): ?string
	{
		return $this->emailId;
	}

	public function getDate(): ?DateTime
	{
		return $this->date;
	}

	public function getIp(): ?string
	{
		return $this->ip;
	}

	public function getIpOrig(): ?string
	{
		return $this->ipOrig;
	}

	public function getMailingListId(): ?string
	{
		return $this->mailingListId;
	}

	public function getSendId(): ?string
	{
		return $this->sendId;
	}

	public function getMessageId(): ?string
	{
		return $this->messageId;
	}

	public function getTopicActiveId(): ?string
	{
		return $this->topicActiveId;
	}

	public function getTopicInactiveId(): ?string
	{
		return $this->topicInactiveId;
	}

	public function getTimeout(): ?string
	{
		return $this->timeout;
	}

	public function getExpire(): ?DateTime
	{
		return $this->expire;
	}

	public function getMethod(): ?UnsubscribeMethod
	{
		return $this->method;
	}

	public function getUnsubscribeAnswer(): ?string
	{
		return $this->unsubscribeAnswer;
	}

	public function getUnsubscribeNote(): ?string
	{
		return $this->unsubscribeNote;
	}
}
