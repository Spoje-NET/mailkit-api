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

use Igloonet\MailkitApi\Exceptions\Message\DuplicateAttachmentNameException;

class Message
{
    private User $user;
    private ?string $subject = null;
    private ?string $body = null;
    private array $templateVars = [];

    /**
     * @var array|Attachment[]
     */
    private array $attachments = [];

    public function __construct(User $sendToUser)
    {
        $this->user = $sendToUser;
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

    /**
     * @return $this
     */
    public function setSubject(?string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @return $this
     */
    public function setBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @return $this
     */
    public function setTemplateVars(array $templateVars): self
    {
        $this->templateVars = $templateVars;

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

    public function getTemplateVars(): array
    {
        return $this->templateVars;
    }

    /**
     * @return $this
     */
    public function addAttachment(Attachment $attachment): self
    {
        $name = $attachment->getName();

        if (isset($this->attachments[$name])) {
            throw new DuplicateAttachmentNameException($name);
        }

        $this->attachments[$name] = $attachment;

        return $this;
    }

    /**
     * @return array|Attachment[]
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }
}
