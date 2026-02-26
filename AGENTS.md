# AGENTS.md - AI Agent Guidelines for mailkit-api

## Project Context
This is a PHP client library for the [Mailkit](https://www.mailkit.com/) email marketing platform API.
It wraps the Mailkit XML-RPC and JSON API interfaces into a typed, object-oriented PHP library.

**Repository**: https://github.com/Spoje-NET/mailkit-api
**Package**: meditorial/mailkit-api
**PHP**: >= 8.1
**License**: BSD-3-Clause

## Architecture

### Entry Point
`MailkitApi` class is the main entry point. It creates manager instances with a shared RPC client.

### Managers
Each API area has a dedicated manager:
- `UsersManager` - User/subscriber management (getstatus, adduser, edituser, unsubscribe, revalidate, delete)
- `MailingListsManager` - Mailing list CRUD operations
- `MessagesManager` - Campaign mail sending (sendmail)
- `WebHooksManager` - Webhook payload processing (subscribe/unsubscribe)

### RPC Layer
- `Client` dispatches requests to adapters
- `XmlAdapter` - XML-RPC via `xmlrpc_encode_request` / `xmlrpc_decode` to https://api.mailkit.eu/rpc.fcgi
- `JsonAdapter` - JSON API via `Nette\Utils\Json` to https://api.mailkit.eu/json.fcgi
- Both adapters require `client_id` and `client_md5` authentication

### Enums
All enums use **native PHP 8.1 backed enums** (not the Consistence library):
- `Gender: string` (M, F)
- `UserStatus: string` (enabled, disabled, unknown, temporary, permanent, unsubscribe)
- `InsertStatus: int` (0-4)
- `SendMailResultStatus: int` (0-4, 6-7)
- `MailingListStatus: string` (enabled, disabled)
- `UnsubscribeMethod: string` (link_in_mail, manual, spam_report, etc.)

Use `::from($value)` to create, `::tryFrom($value)` for nullable, `->value` to get the scalar value.

## Coding Standards
- PHP CS Fixer with `ergebnis/php-cs-fixer-config` (Php81 ruleset)
- Run `make cs` to auto-fix
- Run `make static-code-analysis` for PHPStan

## Testing
- **Framework**: Nette Tester (NOT PHPUnit)
- **Test files**: `tests/IgloonetTests/MailkitApi/*.phpt`
- **Run**: `make tests` or `vendor/bin/tester tests`
- Mock adapters (`XmlAdapterMock`, `JsonAdapterMock`) load fixture XML/JSON files from `tests/IgloonetTests/MailkitApi/mock-files/api-data/`
- `ClientMock` wires mock adapters into the RPC client

## Common Pitfalls
- Do NOT use `Consistence\Enum\Enum` or `::get()` — use native PHP enums with `::from()`
- Do NOT use `Strings::startsWith` / `Strings::endsWith` — use native `str_starts_with` / `str_ends_with`
- The `ext-xmlrpc` PHP extension is required and must be installed separately on PHP 8.x+
- Mailkit API always uses UTF-8 encoding
- API calls require whitelisted IP addresses configured in the Mailkit account

## Mailkit API Reference
https://www.mailkit.com/resources/api/api-introduction
