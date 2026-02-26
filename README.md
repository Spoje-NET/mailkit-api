Spoje-NET/MailkitApi
======

PHP client library for the [Mailkit](https://www.mailkit.com/) email marketing platform API.

Supports both XML-RPC and JSON API interfaces.

Requirements
------------

- PHP >= 8.1
- ext-xmlrpc
- ext-mbstring

Installation
------------

The best way to install is using [Composer](http://getcomposer.org/):

```sh
composer require meditorial/mailkit-api
```

Usage
-----

```php
use Igloonet\MailkitApi\MailkitApi;

$api = new MailkitApi('your_client_id', 'your_client_md5');

// Get mailing lists
$mailingLists = $api->getMailingListsManager()->getMailingLists();

// Get user by email
$users = $api->getUsersManager()->getUsersByEmailAddress('user@example.com');

// Send mail
$api->getMessagesManager()->sendMail($message, $mailingListId, $campaignId);
```

Development
-----------

```sh
git clone git@github.com:Spoje-NET/mailkit-api.git
cd mailkit-api
composer install

# Run tests
make tests

# Run static analysis
make static-code-analysis

# Fix coding standards
make cs
```

API Documentation
-----------------

See the [Mailkit API documentation](https://www.mailkit.com/resources/api/api-introduction) for available endpoints.

License
-------

BSD-3-Clause. See [LICENSE.md](LICENSE.md).

