# StreamLabs Provider for OAuth 2.0 Client

This package provides StreamLabs OAuth 2.0 support for the PHP League's [OAuth 2.0 Client](https://github.com/thephpleague/oauth2-client).

## Installation

To install, use composer:

```
composer require jrodella/oauth2-streamlabs
```

## Usage

Usage is the same as The League's OAuth client, using `Jrodella\OAuth2\Client\Provider\StreamLabs` as the provider.

```php
$provider = new \Jrodella\OAuth2\Client\Provider\StreamLabs([
    'clientId' => "YOUR_CLIENT_ID",
    'clientSecret' => "YOUR_CLIENT_SECRET",
    'redirectUri' => "http://your-redirect-uri-passed-in-streamlabs-dashboard"
]);
```
You can also optionally add a `scopes` key to the array passed to the constructor. The available scopes are documented
on the [StreamLabs API Reference](https://dev.streamlabs.com/docs/getting-started).

Testing
---------
```bash
$ ./vendor/bin/phpunit
```
