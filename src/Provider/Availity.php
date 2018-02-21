<?php

namespace Drewhammond\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\ResponseInterface;

class Availity extends AbstractProvider{
	/**
	 * Returns the base URL for authorizing a client.
	 *
	 * Eg. https://oauth.service.com/authorize
	 *
	 * @return string
	 */
	public function getBaseAuthorizationUrl() {
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
	public function getBaseAccessTokenUrl( array $params ) {
		return 'https://api.availity.com/availity/v1/token';
	}

	/**
	 * Returns the URL for requesting the resource owner's details.
	 *
	 * Availity does not support this so we'll just return an empty string
	 *
	 * @param AccessToken $token
	 *
	 * @return string
	 */
	public function getResourceOwnerDetailsUrl( AccessToken $token ) {
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
	protected function getDefaultScopes() {
		return [ 'hipaa' ];
	}

	/**
	 * Checks a provider response for errors.
	 *
	 * @param  ResponseInterface $response
	 * @param  array|string $data Parsed response data
	 *
	 * @return void
	 */
	protected function checkResponse( ResponseInterface $response, $data ) {
		// TODO: Implement some actual checking here...
	}

	/**
	 * Generates a resource owner object from a successful resource owner
	 * details request.
	 *
	 * Availity does not support this so we'll just return an empty interface
	 *
	 * @param  array $response
	 * @param  AccessToken $token
	 *
	 * @return \League\OAuth2\Client\Provider\ResourceOwnerInterface
	 */
	protected function createResourceOwner( array $response, AccessToken $token ) {
		return null;
	}

	/**
	 * Requests an access token using a specified grant and option set.
	 *
	 * @param  mixed $grant
	 * @param  array $options
	 *
	 * @return AccessToken
	 */
	public function getAccessToken( $grant, array $options = [] ) {

		$grant = $this->verifyGrant( $grant );

		$params = [
			'client_id'     => $this->clientId,
			'client_secret' => $this->clientSecret,
			'redirect_uri'  => $this->redirectUri,
			'scope'         => 'hipaa',
		];

		$params = $grant->prepareRequestParameters( $params, $options );

		$request = $this->getAccessTokenRequest( $params );

		$response = $this->getParsedResponse( $request );

		$token = $this->createAccessToken( $response, $grant );

		return $token;
	}
}
