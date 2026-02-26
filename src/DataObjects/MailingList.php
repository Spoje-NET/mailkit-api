<?php

declare(strict_types=1);

/**
 * This file is part of the MailkitApi package
 *
 * https://github.com/Vitexus/mailkit-api/
 *
 * (c) SpojeNet IT s.r.o. <https://spojenet.cz/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Igloonet\MailkitApi\DataObjects;

use Igloonet\MailkitApi\DataObjects\Enums\MailingListStatus;

class MailingList
{
    private ?int $id = null;

    private ?string $name = null;

    private ?MailingListStatus $status = null;

    private ?string $description = null;

    /**
     * @return $this
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return $this
     */
    public function setName(?string $name): self
    {
        $this->name = trim($name ?? '') === '' ? null : trim($name);

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return $this
     */
    public function setStatus(?MailingListStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStatus(): ?MailingListStatus
    {
        return $this->status;
    }

    /**
     * @return $this
     */
    public function setDescription(?string $description): self
    {
        $this->description = trim($description ?? '') === '' ? null : trim($description);

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public static function create(int $id, string $name, MailingListStatus $status, string $description): self
    {
        $mailingList = new static();

        $mailingList->setId($id);
        $mailingList->setName($name);
        $mailingList->setStatus($status);
        $mailingList->setDescription($description);

        return $mailingList;
    }
}
