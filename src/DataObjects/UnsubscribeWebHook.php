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

use Igloonet\MailkitApi\DataObjects\Enums\UnsubscribeMethod;
use Nette\Utils\DateTime;

class UnsubscribeWebHook
{
    private ?User $user = null;
    private ?string $emailId = null;
    private ?DateTime $date = null;
    private ?string $ip = null;
    private ?string $ipOrig = null;
    private ?string $mailingListId = null;
    private ?string $sendId = null;
    private ?string $messageId = null;
    private ?string $topicActiveId = null;
    private ?string $topicInactiveId = null;
    private ?string $timeout = null;
    private ?DateTime $expire = null;
    private ?UnsubscribeMethod $method = null;
    private ?string $unsubscribeAnswer = null;
    private ?string $unsubscribeNote = null;

    /**
     * $jsonContent.
     */
    private $jsonContent;

    private function __construct(array $jsonContent, User $user)
    {
        $this->jsonContent = $jsonContent;
        $this->user = $user;
    }

    public static function fromArray($jsonContent)
    {
        // validation

        $user = self::createUser($jsonContent);
        $subscribe = new static($jsonContent, $user);

        $subscribe->user = $user;
        $subscribe->emailId = self::validateEmptyString($jsonContent['ID_EMAIL']);
        $subscribe->date = new DateTime($jsonContent['DATE']);
        $subscribe->ip = self::validateIp($jsonContent['IP']);
        $subscribe->ipOrig = self::validateIp($jsonContent['IP_ORIG']);
        $subscribe->mailingListId = self::validateEmptyString($jsonContent['ID_ML']);
        $subscribe->sendId = self::validateEmptyString($jsonContent['ID_SEND']);
        $subscribe->messageId = self::validateEmptyString($jsonContent['ID_MESSAGE']);
        $subscribe->topicActiveId = self::validateEmptyString($jsonContent['ID_TOPIC_ACTIVE']);
        $subscribe->topicInactiveId = self::validateEmptyString($jsonContent['ID_TOPIC_INACTIVE']);
        $subscribe->timeout = self::validateEmptyString($jsonContent['TIMEOUT']);
        $subscribe->expire = new DateTime($jsonContent['EXPIRE']);
        $subscribe->method = UnsubscribeMethod::from($jsonContent['METHOD']);
        $subscribe->unsubscribeAnswer = self::validateEmptyString($jsonContent['UNSUBSCRIBE_ANSWER']);
        $subscribe->unsubscribeNote = self::validateEmptyString($jsonContent['UNSUBSCRIBE_NOTE']);

        return $subscribe;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function getEmailId(): ?string
    {
        return $this->emailId;
    }

    public function getDate(): ?DateTime
    {
        return $this->date;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function getIpOrig(): ?string
    {
        return $this->ipOrig;
    }

    public function getMailingListId(): ?string
    {
        return $this->mailingListId;
    }

    public function getSendId(): ?string
    {
        return $this->sendId;
    }

    public function getMessageId(): ?string
    {
        return $this->messageId;
    }

    public function getTopicActiveId(): ?string
    {
        return $this->topicActiveId;
    }

    public function getTopicInactiveId(): ?string
    {
        return $this->topicInactiveId;
    }

    public function getTimeout(): ?string
    {
        return $this->timeout;
    }

    public function getExpire(): ?DateTime
    {
        return $this->expire;
    }

    public function getMethod(): ?UnsubscribeMethod
    {
        return $this->method;
    }

    public function getUnsubscribeAnswer(): ?string
    {
        return $this->unsubscribeAnswer;
    }

    public function getUnsubscribeNote(): ?string
    {
        return $this->unsubscribeNote;
    }

    private static function validateEmptyString($string)
    {
        return trim($string ?? '') === '' ? null : trim($string);
    }

    private static function validateIp($ipAddress)
    {
        if (filter_var($ipAddress, \FILTER_VALIDATE_IP)) {
            return $ipAddress;
        }

        return null;
    }

    private static function createUser(array $jsonContent): User
    {
        return new User($jsonContent['EMAIL']);
    }
}
