<?php
declare(strict_types = 1);

namespace Igloonet\MailkitApi\Managers;

use Igloonet\MailkitApi\DataObjects\User;
use Igloonet\MailkitApi\Exceptions\UnsupportedLanguageException;
use Igloonet\MailkitApi\RPC\Client;
use Igloonet\MailkitApi\RPC\Responses\IRpcResponse;
use Nette\Utils\Strings;

abstract class BaseManager
{
	final public const LANGUAGE_DEFAULT = 'default';

	/** @var string|null */
	protected $defaultLanguage = null;

	/**
	 * @param Client $client
	 * @param mixed[] $enabledLanguages
	 * @param string $defaultLanguage
	 */
	public function __construct(protected Client $client, protected array $enabledLanguages, string $defaultLanguage)
	{
		$this->defaultLanguage = $this->validateLanguage($defaultLanguage);
	}

	protected function validateLanguage(?string $language): ?string
	{
		if ($language === null) {
			return null;
		} elseif ($language === self::LANGUAGE_DEFAULT) {
			return $this->defaultLanguage;
		}

		$language = trim(Strings::lower($language));

		if (!in_array($language, $this->enabledLanguages, true)) {
			throw new UnsupportedLanguageException($language);
		}

		return $language;
	}

	/**
	 * @param mixed[] $params
	 * @param mixed[] $possibleErrors
	 */
	protected function sendRpcRequest(string $method, array $params, array $possibleErrors): IRpcResponse
	{
		return $this->client->sendRpcRequest($method, $params, $possibleErrors);
	}

	protected function getBooleanString(bool $value): string
	{
		return $value === true ? "TRUE" : "FALSE";
	}

	/**
	 * @return mixed[][]
	 */
	protected function getUserDataSections(User $user, ?string $returnUrl, ?string $templateId): array
	{
		$data1 = [
			'ID_template' => $this->encodeString($templateId),
			'return_url' => $this->encodeString($returnUrl),
			'vocative' => $this->encodeString($user->getVocative()),
			'prefix' => $this->encodeString($user->getPrefix()),
			'first_name' => $this->encodeString($user->getFirstName()),
			'last_name' => $this->encodeString($user->getLastName()),
			'status' => $user->getStatus(),
			'email' => $this->encodeString($user->getEmail()),
			'reply_to' => $this->encodeString($user->getReplyTo()),
			'company' => $this->encodeString($user->getCompany()),
		];

		$data2 = [
			'nick_name' => $this->encodeString($user->getNickName()),
			'country' => $this->encodeString($user->getCountry()),
			'street' => $this->encodeString($user->getStreet()),
			'state' => $this->encodeString($user->getState()),
			'zip' => $this->encodeString($user->getZip()),
			'city' => $this->encodeString($user->getCity()),
			'mobile' => $this->encodeString($user->getMobile()),
			'phone' => $this->encodeString($user->getPhone()),
			'fax' => $this->encodeString($user->getFax()),
			'gender' => $user->getGender(),
		];

		$data3 = [];
		foreach ($user->getCustomFields() as $fieldNumber => $value) {
			$data3['custom' . $fieldNumber] = $this->encodeString($value);
		}

		$data1 = $this->filterNullsFromArray($data1);
		$data2 = $this->filterNullsFromArray($data2);
		$data3 = $this->filterNullsFromArray($data3);

		return [$data1, $data2, $data3];
	}

	/**
	 * @param string $str |null
	 *
	 * @return string
	 */
	protected function encodeString(?string $str = null): ?string
	{
		return $str === null ? null : base64_encode($str);
	}

	/**
	 * @param mixed[] $arr
	 *
	 * @return mixed[]
	 */
	protected function filterNullsFromArray(array $arr): array
	{
		return array_filter($arr, static fn($value) => $value !== null);
	}

	/**
	 * @param mixed[] $dataSections
	 *
	 * @return mixed[]
	 */
	protected function fixEmptyUserDataSections(array $dataSections): array
	{
		foreach ($dataSections as &$dataSection) {
			if ((is_countable($dataSection) ? count($dataSection) : 0) === 0) {
				$dataSection[''] = null; // forces xmlrpc_encode_request to generate struct instead of array
			}
		}

		return $dataSections;
	}
}
