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

namespace Igloonet\MailkitApi\Exceptions;

class UnsupportedLanguageException extends InvalidArgumentException
{
    private string $language = null;

    public function __construct(string $language, string $message = '', int $code = 0, ?\Throwable $previous = null)
    {
        $this->language = $language;

        if (trim($message) === '') {
            $message = sprintf('Language %s is not supported by Mailkit API', $language);
        }

        parent::__construct($message, $code, $previous);
    }
}
