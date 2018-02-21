<?php

namespace Drewhammond\OAuth2\Client\Test\Provider;

use Drewhammond\OAuth2\Client\Provider\Availity;
use League\OAuth2\Client\Token\AccessToken;
use Mockery as mock;
use PHPUnit\Framework\TestCase;

class AvailityTest extends TestCase
{
    /** @var Availity */
    protected $provider;

    protected function setUp()
    {
        $this->provider = new Availity([
            'clientId'     => 'TEST_CLIENT_ID_VALUE',
            'clientSecret' => 'TEST_CLIENT_SECRET_VALUE',
        ]);
    }

    public function tearDown()
    {
        mock::close();
        parent::tearDown();
    }

    public function testInit()
    {
        $this->assertTrue(true);
    }

    public function testGetAccessToken()
    {
        $timestamp = time();

        $response = mock::mock('Psr\Http\Message\ResponseInterface');
        $response->shouldReceive('getBody')->andReturn('{"token_type":"bearer","access_token":"TEST_ACCESS_TOKEN_VALUE","expires_in": 300,"consented_on":' . $timestamp . ',"scope":"hipaa"}');
        $response->shouldReceive('getHeader')->andReturn(['content-type' => 'application/json']);
        $response->shouldReceive('getStatusCode')->andReturn(200);
        $client = mock::mock('GuzzleHttp\ClientInterface');
        $client->shouldReceive('send')->times(1)->andReturn($response);
        $this->provider->setHttpClient($client);
        $token = $this->provider->getAccessToken('client_credentials');

        $this->assertEquals('TEST_ACCESS_TOKEN_VALUE', $token->getToken());
        $this->assertEquals($timestamp + 300, $token->getExpires());
        $this->assertFalse($token->hasExpired());
        $this->assertNull($token->getRefreshToken());
        $this->assertNull($token->getResourceOwnerId());
    }

    public function testGetResourceOwnerDetailsUrl()
    {
        $token = new AccessToken(['access_token' => 'TEST_ACCESS_TOKEN_VALUE', 'expires_in' => 300]);
        $this->assertEquals('', $this->provider->getResourceOwnerDetailsUrl($token));
    }

    /**
     * Pointless test
     */
    public function testGetBaseAuthorizationUrl()
    {
        $this->assertEquals('https://api.availity.com/availity/v1/token', $this->provider->getBaseAuthorizationUrl());
    }

    /**
     * Pointless test
     */
    public function testGetBaseAccessTokenUrl()
    {
        $this->assertEquals('https://api.availity.com/availity/v1/token', $this->provider->getBaseAccessTokenUrl([]));
    }
}