<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi\DataObjects;

use Igloonet\MailkitApi\Exceptions\Message\DuplicateAttachmentNameException;

class Message
{
	private ?string $subject = null;

	private ?string $body = null;

	/** @var mixed[] */
	private array $templateVars = [];

	/** @var array|Attachment[] */
	private array $attachments = [];

	public function __construct(private User $user)
	{
	}

	public function getUser(): User
	{
		return $this->user;
	}

	/**
	 * @return $this
	 */
	public function setUser(User $user): self
	{
		$this->user = $user;

		return $this;
	}

	public function getSubject(): ?string
	{
		return $this->subject;
	}

	/**
	 * @return $this
	 */
	public function setSubject(?string $subject): self
	{
		$this->subject = $subject;

		return $this;
	}

	public function getBody(): ?string
	{
		return $this->body;
	}

	/**
	 * @return $this
	 */
	public function setBody(?string $body): self
	{
		$this->body = $body;

		return $this;
	}

	/**
	 * @param mixed $value
	 *
	 * @return $this
	 */
	public function setTemplateVar(string $varName, $value): self
	{
		$this->templateVars[$varName] = $value;

		return $this;
	}

	/**
	 * @return mixed[]
	 */
	public function getTemplateVars(): array
	{
		return $this->templateVars;
	}

	/**
	 * @param mixed[] $templateVars
	 *
	 * @return $this
	 */
	public function setTemplateVars(array $templateVars): self
	{
		$this->templateVars = $templateVars;

		return $this;
	}

	/**
	 * @return $this
	 */
	public function addAttachment(Attachment $attachment): self
	{
		$name = $attachment->getName();

		if ($name !== null && isset($this->attachments[$name])) {
			throw new DuplicateAttachmentNameException($name);
		}

		$this->attachments[$name] = $attachment;

		return $this;
	}

	/**
	 * @return Attachment[]
	 */
	public function getAttachments(): array
	{
		return $this->attachments;
	}
}
