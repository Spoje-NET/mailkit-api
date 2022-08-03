<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi\DataObjects;

use Igloonet\MailkitApi\DataObjects\Enums\MailingListStatus;

final class MailingList
{
	private ?int $id = null;

	private ?string $name = null;

	private ?\Igloonet\MailkitApi\DataObjects\Enums\MailingListStatus $status = null;

	private ?string $description = null;

	public static function create(int $id, string $name, MailingListStatus $status, string $description): self
	{
		$mailingList = new self();

		$mailingList->setId($id);
		$mailingList->setName($name);
		$mailingList->setStatus($status);
		$mailingList->setDescription($description);

		return $mailingList;
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

	public function getName(): ?string
	{
		return $this->name;
	}

	/**
	 * @return $this
	 */
	public function setName(?string $name): self
	{
		if ($name === null) {
			$name = '';
		}
		$this->name = trim($name) === '' ? null : trim($name);

		return $this;
	}

	public function getStatus(): ?MailingListStatus
	{
		return $this->status;
	}

	/**
	 * @return $this
	 */
	public function setStatus(?MailingListStatus $status): self
	{
		$this->status = $status;

		return $this;
	}

	public function getDescription(): ?string
	{
		return $this->description;
	}

	/**
	 * @return $this
	 */
	public function setDescription(?string $description): self
	{
		if ($description === null) {
			$description = '';
		}
		$this->description = trim($description) === '' ? null : trim($description);

		return $this;
	}
}
