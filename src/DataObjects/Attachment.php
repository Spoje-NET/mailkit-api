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

namespace Igloonet\MailkitApi\DataObjects;

use Igloonet\MailkitApi\Exceptions\Message\AttachmentEmptyContentException;
use Igloonet\MailkitApi\Exceptions\Message\AttachmentFileNotFoundException;
use Igloonet\MailkitApi\Exceptions\Message\AttachmentFileNotReadableException;

class Attachment
{
    private ?string $name = null;
    private ?string $filePath = null;
    private ?string $content = null;

    public function __construct(string $name)
    {
        $this->name = $name;
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
            sprintf('Content of attachment %s can not be empty!', $this->name),
        );
    }

    public static function fromFile(string $filePath, ?string $name = null): self
    {
        if (trim($name ?? '') === '') {
            $name = pathinfo($filePath, \PATHINFO_BASENAME);
        }

        $attachment = new static($name);
        $attachment->filePath = $filePath;

        return $attachment;
    }

    public static function fromString(string $content, string $name): self
    {
        $attachment = new static($name);

        $attachment->content = $content;

        return $attachment;
    }
}
