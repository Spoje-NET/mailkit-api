<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi\DataObjects;

use Igloonet\MailkitApi\DataObjects\Enums\Gender;
use Igloonet\MailkitApi\DataObjects\Enums\InsertStatus;
use Igloonet\MailkitApi\DataObjects\Enums\UserStatus;
use Igloonet\MailkitApi\Exceptions\User\InvalidCustomFieldNumberException;

class User
{
	final public const CUSTOM_FIELDS_CNT = 25;

	private ?int $id = null;

	private ?\Igloonet\MailkitApi\DataObjects\Enums\UserStatus $status = null;

	private ?\Igloonet\MailkitApi\DataObjects\Enums\InsertStatus $insertStatus = null;

	private ?string $firstName = null;

	private ?string $lastName = null;

	private ?string $prefix = null;

	private ?string $vocative = null;

	private ?string $nickName = null;

	private ?string $company = null;

	private ?\Igloonet\MailkitApi\DataObjects\Enums\Gender $gender = null;

	private ?string $phone = null;

	private ?string $mobile = null;

	private ?string $fax = null;

	private ?string $street = null;

	private ?string $city = null;

	private ?string $state = null;

	private ?string $country = null;

	private ?string $zip = null;

	private ?string $replyTo = null;

	private ?int $mailingListId = null;

	/** @var array|string[] */
	private $customFields = [];

	public function __construct(private ?string $email = null)
	{
	}

	public function getId(): ?int
	{
		return $this->id;
	}

	/**
	 * @return $this
	 */
	public function setId(?int $id): self
	{
		$this->id = $id;

		return $this;
	}

	public function getStatus(): ?UserStatus
	{
		return $this->status;
	}

	/**
	 * @return $this
	 */
	public function setStatus(?UserStatus $status): self
	{
		$this->status = $status;

		return $this;
	}

	public function getInsertStatus(): ?InsertStatus
	{
		return $this->insertStatus;
	}

	/**
	 * @return $this
	 */
	public function setInsertStatus(?InsertStatus $insertStatus): self
	{
		$this->insertStatus = $insertStatus;

		return $this;
	}

	/**
	 * @return $this
	 */
	public function setEmail(?string $email): self
	{
		$this->email = $email === null ? null : trim($email);

		return $this;
	}

	public function getEmail(): ?string
	{
		return $this->email;
	}

	public function getFirstName(): ?string
	{
		return $this->firstName;
	}

	/**
	 * @return $this
	 */
	public function setFirstName(?string $firstName): self
	{
		$this->firstName = $firstName;

		return $this;
	}

	public function getLastName(): ?string
	{
		return $this->lastName;
	}

	/**
	 * @return $this
	 */
	public function setLastName(?string $lastName): self
	{
		$this->lastName = $lastName;

		return $this;
	}

	public function getPrefix(): ?string
	{
		return $this->prefix;
	}

	/**
	 * @return $this
	 */
	public function setPrefix(?string $prefix): self
	{
		$this->prefix = $prefix;

		return $this;
	}

	public function getVocative(): ?string
	{
		return $this->vocative;
	}

	/**
	 * @return $this
	 */
	public function setVocative(?string $vocative): self
	{
		$this->vocative = $vocative;

		return $this;
	}

	public function getNickName(): ?string
	{
		return $this->nickName;
	}

	/**
	 * @return $this
	 */
	public function setNickName(?string $nickName): self
	{
		$this->nickName = $nickName;

		return $this;
	}

	public function getCompany(): ?string
	{
		return $this->company;
	}

	/**
	 * @return $this
	 */
	public function setCompany(?string $company): self
	{
		$this->company = $company;

		return $this;
	}

	public function getGender(): ?Gender
	{
		return $this->gender;
	}

	/**
	 * @return $this
	 */
	public function setGender(?Gender $gender): self
	{
		$this->gender = $gender;

		return $this;
	}

	public function getPhone(): ?string
	{
		return $this->phone;
	}

	/**
	 * @return $this
	 */
	public function setPhone(?string $phone): self
	{
		$this->phone = $phone;

		return $this;
	}

	public function getMobile(): ?string
	{
		return $this->mobile;
	}

	/**
	 * @return $this
	 */
	public function setMobile(?string $mobile): self
	{
		$this->mobile = $mobile;

		return $this;
	}

	public function getFax(): ?string
	{
		return $this->fax;
	}

	/**
	 * @return $this
	 */
	public function setFax(?string $fax): self
	{
		$this->fax = $fax;

		return $this;
	}

	public function getStreet(): ?string
	{
		return $this->street;
	}

	/**
	 * @return $this
	 */
	public function setStreet(?string $street): self
	{
		$this->street = $street;

		return $this;
	}

	public function getCity(): ?string
	{
		return $this->city;
	}

	/**
	 * @return $this
	 */
	public function setCity(?string $city): self
	{
		$this->city = $city;

		return $this;
	}

	public function getState(): ?string
	{
		return $this->state;
	}

	/**
	 * @return $this
	 */
	public function setState(?string $state): self
	{
		$this->state = $state;

		return $this;
	}

	public function getCountry(): ?string
	{
		return $this->country;
	}

	/**
	 * @return $this
	 */
	public function setCountry(?string $country): self
	{
		$this->country = $country;

		return $this;
	}

	public function getZip(): ?string
	{
		return $this->zip;
	}

	/**
	 * @return $this
	 */
	public function setZip(?string $zip): self
	{
		$this->zip = $zip;

		return $this;
	}

	public function getReplyTo(): ?string
	{
		return $this->replyTo;
	}

	/**
	 * @return $this
	 */
	public function setReplyTo(?string $replyTo): self
	{
		$this->replyTo = $replyTo;

		return $this;
	}

	public function getMailingListId(): ?int
	{
		return $this->mailingListId;
	}

	/**
	 * @return $this
	 */
	public function setMailingListId(?int $mailingListId): self
	{
		$this->mailingListId = $mailingListId;

		return $this;
	}

	/**
	 * @return $this
	 * @throws InvalidCustomFieldNumberException
	 */
	public function removeCustomField(int $fieldNumber): self
	{
		$this->assertValidCustomFieldNumber($fieldNumber);

		unset($this->customFields[$fieldNumber]);

		return $this;
	}

	/**
	 * @throws InvalidCustomFieldNumberException
	 */
	public function getCustomField(int $fieldNumber): ?string
	{
		$this->assertValidCustomFieldNumber($fieldNumber);

		return $this->customFields[$fieldNumber] ?? null;
	}

	/**
	 * @return array|string[]
	 */
	public function getCustomFields(): array
	{
		return $this->customFields;
	}

	/**
	 * @param mixed[] $customFields
	 *
	 * @return $this
	 * @throws InvalidCustomFieldNumberException
	 */
	public function setCustomFields(array $customFields): self
	{
		$this->customFields = [];

		foreach ($customFields as $fieldNumber => $value) {
			$this->setCustomField($fieldNumber, $value);
		}

		return $this;
	}

	/**
	 * @return $this
	 * @throws InvalidCustomFieldNumberException
	 */
	public function setCustomField(int $fieldNumber, ?string $value): self
	{
		$this->assertValidCustomFieldNumber($fieldNumber);

		if ($value !== null) {
			$this->customFields[$fieldNumber] = $value;
		}

		return $this;
	}

	/**
	 * @throws InvalidCustomFieldNumberException
	 */
	private function assertValidCustomFieldNumber(int $fieldNumber): bool
	{
		if (!$this->isValidCustomFieldNumber($fieldNumber)) {
			throw new InvalidCustomFieldNumberException(
				sprintf(
					'Invalid custom field number %d. Custom field number must be between %d and %d.',
					$fieldNumber,
					1,
					self::CUSTOM_FIELDS_CNT
				)
			);
		}

		return true;
	}

	private function isValidCustomFieldNumber(int $fieldNumber): bool
	{
		return $fieldNumber >= 1 && $fieldNumber <= self::CUSTOM_FIELDS_CNT;
	}

	private function isValidGender(string $gender): bool
	{
		return in_array(trim($gender), [
			Gender::getAvailableValues(),
			'male',
			'female',
			'muz',
			'zena',
			'm',
			'f',
		], true);
	}
}
