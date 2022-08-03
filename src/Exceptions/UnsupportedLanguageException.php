<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi\Exceptions;

use Throwable;

class UnsupportedLanguageException extends InvalidArgumentException
{
	public function __construct(private readonly string $language, string $message = '', int $code = 0, Throwable $previous = null)
	{
		if (trim($message) === '') {
			$message = sprintf('Language %s is not supported by Mailkit API', $language);
		}

		parent::__construct($message, $code, $previous);
	}
}
