<?php
/** @noinspection ALL */
declare(strict_types = 1);

namespace Igloonet\MailkitApi\DataObjects;

use Igloonet\MailkitApi\DataObjects\Enums\Gender;
use Nette\Utils\DateTime;

final class SubscribeWebHook
{
	private ?string $emailId = null;

	private ?\Nette\Utils\DateTime $date = null;

	private ?string $ip = null;

	private ?string $ipOrig = null;

	private ?string $mailingListId = null;

	private ?string $channel = null;

	private ?string $userAgentString = null;

	private ?\Nette\Utils\DateTime $dateRequest = null;

	private ?string $userAgentRequest = null;

	private ?string $ipRequest = null;

	private ?string $ipOrigRequest = null;

	private ?string $urlCode = null;

	/**
	 * @param mixed[] $jsonContent
	 * @param User $user
	 *
	 * @noinspection PhpPluralMixedCanBeReplacedWithArrayInspection
	 */
	private function __construct(private readonly array $jsonContent, private ?\Igloonet\MailkitApi\DataObjects\User $user)
	{
	}

	/**
	 * @param mixed[] $jsonContent
	 */
	public static function fromArray(array $jsonContent): self
	{
		$user = self::createUser($jsonContent);
		$subscribe = new self($jsonContent, $user);

		$subscribe->user = $user;
		$subscribe->emailId = self::validateEmptyString($jsonContent['ID_EMAIL']);
		$subscribe->ip = self::validateIp($jsonContent['IP']);
		$subscribe->ipOrig = self::validateIp($jsonContent['IP_ORIG']);
		$subscribe->mailingListId = self::validateEmptyString($jsonContent['ID_ML']);
		$subscribe->channel = self::validateEmptyString($jsonContent['CHANNEL']);
		$subscribe->userAgentString = self::validateEmptyString($jsonContent['UA']);
		$subscribe->userAgentRequest = self::validateEmptyString($jsonContent['UA_REQUEST']);
		$subscribe->ipRequest = self::validateIp($jsonContent['IP_REQUEST']);
		$subscribe->ipOrigRequest = self::validateIp($jsonContent['IP_ORIG_REQUEST']);
		$subscribe->urlCode = self::validateEmptyString($jsonContent['URL_CODE']);

		try {
			$subscribe->date = new DateTime($jsonContent['DATE']);
			$subscribe->dateRequest = new DateTime($jsonContent['DATE_REQUEST']);
		} catch (\Exception) {
		}

		return $subscribe;
	}

	/**
	 * @param mixed[] $jsonContent
	 */
	private static function createUser(array $jsonContent): User
	{
		$user = new User($jsonContent['EMAIL']);
		$user->setFirstName(self::validateEmptyString($jsonContent['FIRST_NAME']));
		$user->setLastName(self::validateEmptyString($jsonContent['LAST_NAME']));
		$user->setFax(self::validateEmptyString($jsonContent['FAX']));
		$user->setGender(Gender::from($jsonContent['GENDER']));
		$user->setMobile(self::validateEmptyString($jsonContent['MOBILE']));
		$user->setNickName(self::validateEmptyString($jsonContent['NICK_NAME']));
		$user->setPhone(self::validateEmptyString($jsonContent['PHONE']));
		$user->setPrefix(self::validateEmptyString($jsonContent['PREFIX']));
		$user->setReplyTo(self::validateEmptyString($jsonContent['REPLY_TO']));
		$user->setState(self::validateEmptyString($jsonContent['STATE']));
		$user->setStreet(self::validateEmptyString($jsonContent['STREET']));
		$user->setVocative(self::validateEmptyString($jsonContent['VOCATIVE']));
		$user->setZip(self::validateEmptyString($jsonContent['ZIP']));
		$user->setCity(self::validateEmptyString($jsonContent['CITY']));
		$user->setCompany(self::validateEmptyString($jsonContent['COMPANY']));
		$user->setCountry(self::validateEmptyString($jsonContent['COUNTRY']));

		for ($i = 1; $i <= User::CUSTOM_FIELDS_CNT; $i++) {
			$user->setCustomField($i, $jsonContent['CUSTOM' . $i] ?? null);
		}

		return $user;
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

	public function getChannel(): ?string
	{
		return $this->channel;
	}

	public function getUserAgentString(): ?string
	{
		return $this->userAgentString;
	}

	public function getDateRequest(): ?DateTime
	{
		return $this->dateRequest;
	}

	public function getUserAgentRequest(): ?string
	{
		return $this->userAgentRequest;
	}

	public function getIpRequest(): ?string
	{
		return $this->ipRequest;
	}

	public function getIpOrigRequest(): ?string
	{
		return $this->ipOrigRequest;
	}

	public function getUrlCode(): ?string
	{
		return $this->urlCode;
	}
}
