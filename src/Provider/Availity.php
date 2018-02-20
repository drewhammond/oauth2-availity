<?php

namespace Drewhammond\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\AbstractProvider;

class Availity extends AbstractProvider
{
    /**
     * Returns the base URL for authorizing a client.
     *
     * Eg. https://oauth.service.com/authorize
     *
     * @return string
     */
    public function getBaseAuthorizationUrl()
    {
        // TODO: Implement getBaseAuthorizationUrl() method.
        return 'https://api.availity.com/availity/v1/token';
    }

    /**
     * Returns the base URL for requesting an access token.
     *
     * Eg. https://oauth.service.com/token
     *
     * @param array $params
     *
     * @return string
     */
    public function getBaseAccessTokenUrl(array $params)
    {
        return 'https://api.availity.com/availity/v1/token';
    }

    /**
     * Returns the URL for requesting the resource owner's details.
     *
     * Availity does not support this so we'll just return an empty string
     *
     * @param \League\OAuth2\Client\Token\AccessToken $token
     *
     * @return string
     */
    public function getResourceOwnerDetailsUrl(\League\OAuth2\Client\Token\AccessToken $token)
    {
        return '';
    }

    /**
     * Returns the default scopes used by this provider.
     *
     * This should only be the scopes that are required to request the details
     * of the resource owner, rather than all the available scopes.
     *
     * @return array
     */
    protected function getDefaultScopes()
    {
        return ['hipaa'];
    }

    /**
     * Checks a provider response for errors.
     *
     * @throws \League\OAuth2\Client\Provider\Exception\IdentityProviderException
     *
     * @param  \Psr\Http\Message\ResponseInterface $response
     * @param  array|string $data Parsed response data
     *
     * @return void
     */
    protected function checkResponse(\Psr\Http\Message\ResponseInterface $response, $data)
    {
        // TODO: Implement checkResponse() method.
    }

    /**
     * Generates a resource owner object from a successful resource owner
     * details request.
     *
     * Availity does not support this so we'll just return an empty interface
     *
     * @param  array $response
     * @param  \League\OAuth2\Client\Token\AccessToken $token
     *
     * @return \League\OAuth2\Client\Provider\ResourceOwnerInterface
     */
    protected function createResourceOwner(array $response, \League\OAuth2\Client\Token\AccessToken $token)
    {
        return null;
    }
}