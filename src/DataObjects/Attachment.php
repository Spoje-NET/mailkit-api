<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi\DataObjects;

use Igloonet\MailkitApi\Exceptions\Message\AttachmentEmptyContentException;
use Igloonet\MailkitApi\Exceptions\Message\AttachmentFileNotFoundException;
use Igloonet\MailkitApi\Exceptions\Message\AttachmentFileNotReadableException;

final class Attachment
{
	private ?string $filePath = null;

	private ?string $content = null;

	public function __construct(private readonly string $name)
	{
	}

	/**
	 * @param string|null $name
	 */
	public static function fromFile(string $filePath, string $name = null): self
	{
		if (trim($name ?? '') === '') {
			$name = pathinfo($filePath, PATHINFO_BASENAME);
		}

		$attachment = new self((string) $name);
		$attachment->filePath = $filePath;

		return $attachment;
	}

	public static function fromString(string $content, string $name): self
	{
		$attachment = new self($name);

		$attachment->content = $content;

		return $attachment;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function getContent(): string
	{
		if ($this->content !== null) {
			return $this->content;
		}

		if ($this->filePath !== null) {
			if (!file_exists($this->filePath)) {
				throw new AttachmentFileNotFoundException($this->filePath);
			}

			if (!is_readable($this->filePath)) {
				throw new AttachmentFileNotReadableException($this->filePath);
			}

			$fileContent = file_get_contents($this->filePath);

			if ($fileContent !== false) {
				return $fileContent;
			}
		}

		throw new AttachmentEmptyContentException(
			sprintf('Content of attachment %s can not be empty!', $this->name)
		);
	}
}
