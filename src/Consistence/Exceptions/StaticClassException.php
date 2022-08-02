<?php

declare(strict_types = 1);

namespace Igloonet\MailkitApi\Consistence\Exceptions;

/**
 * Should be thrown in constructors of pure-static classes to prevent creating instances
 */
class StaticClassException extends PhpException
{

}
