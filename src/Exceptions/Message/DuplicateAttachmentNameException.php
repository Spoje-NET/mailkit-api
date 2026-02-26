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

namespace Igloonet\MailkitApi\Exceptions\Message;

class DuplicateAttachmentNameException extends \LogicException
{
    private ?string $name = null;

    public function __construct(?string $name, string $message = '', int $code = 0, ?\Throwable $previous = null)
    {
        if (trim($message) === '') {
            $message = sprintf('Attachment with name %s already exists in this message!', $name);
        }

        parent::__construct($message, $code, $previous);
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
