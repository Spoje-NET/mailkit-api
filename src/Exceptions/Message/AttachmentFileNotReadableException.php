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

namespace Igloonet\MailkitApi\Exceptions\Message;

use Igloonet\MailkitApi\Exceptions\IOException;

class AttachmentFileNotReadableException extends IOException implements AttachmentException
{
    private ?string $filePath = null;

    public function __construct(string $filePath, string $message = '', int $code = 0, ?\Throwable $previous = null)
    {
        $this->filePath = $filePath;

        if (trim($message) === '') {
            $message = sprintf('File %s is not readable!', $filePath);
        }

        parent::__construct($message, $code, $previous);
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }
}
