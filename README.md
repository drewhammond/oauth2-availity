# Availity Provider for OAuth 2.0 Client

[![Build Status](https://travis-ci.org/drewhammond/oauth2-availity.svg?branch=master)](https://travis-ci.org/drewhammond/oauth2-availity)
[![Coverage Status](https://coveralls.io/repos/github/drewhammond/oauth2-availity/badge.svg?branch=master)](https://coveralls.io/github/drewhammond/oauth2-availity?branch=master)

@TODO

## Installation

@TODO

## Usage

The example below is taken from a Laravel project with the `AVAILITY_CLIENT_ID` and `AVAILITY_CLIENT_SECRET` defined in the project .env file.


```php

  // Instantiate Availity provider
  $provider = new \Drewhammond\OAuth2\Client\Provider\Availity( [
    'clientId'     => getenv( 'AVAILITY_CLIENT_ID' ),
    'clientSecret' => getenv( 'AVAILITY_CLIENT_SECRET' ),
  ] );

  // Fetch access token using client_credentials grant (only grant type supported by Availity)
  $accessToken = $provider->getAccessToken( 'client_credentials' );

  // Do something with your access token...
  $token   = $accessToken->getToken();
  $expires = $accessToken->getExpires();

```

## Support

Please open a new issue if you run into any problems.

## License

MIT