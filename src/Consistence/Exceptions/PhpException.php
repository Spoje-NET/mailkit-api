<?php

declare(strict_types = 1);

namespace Igloonet\MailkitApi\Consistence\Exceptions;

use Exception;
use Igloonet\MailkitApi\Consistence\Type\ObjectMixinTrait;

class PhpException extends Exception
{

	use ObjectMixinTrait;

	public function __construct(string $message = '', \Throwable $previous = null)
	{
		parent::__construct($message, 0, $previous);
	}

}
