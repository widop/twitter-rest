<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\OAuth;

use Widop\Twitter\OAuth\OAuth;

/**
 * OAuth test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OAuthTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\OAuth\OAuth */
    private $oauth;

    /** @var \Widop\HttpAdapter\HttpAdapterInterface */
    private $httpAdapter;

    /** @var \Widop\Twitter\OAuth\OAuthConsumer */
    private $consumer;

    /** @var \Widop\Twitter\OAuth\Signature\OAuthSignatureInterface */
    private $signature;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->httpAdapter = $this->getMock('Widop\HttpAdapter\HttpAdapterInterface');

        $this->consumer = $this->getMockBuilder('Widop\Twitter\OAuth\OAuthConsumer')
            ->disableOriginalConstructor()
            ->getMock();

        $this->consumer
            ->expects($this->any())
            ->method('getKey')
            ->will($this->returnValue('consumer_key'));

        $this->consumer
            ->expects($this->any())
            ->method('getSecret')
            ->will($this->returnValue('consumer_secret'));

        $this->signature = $this->getMock('Widop\Twitter\OAuth\Signature\OAuthSignatureInterface');

        $this->signature
            ->expects($this->any())
            ->method('generate')
            ->with(
                $this->isInstanceOf('Widop\Twitter\OAuth\OAuthRequest'),
                $this->equalTo('consumer_secret')
            )
            ->will($this->returnValue('signature'));

        $this->signature
            ->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('signature-name'));

        $this->oauth = new OAuth($this->httpAdapter, $this->consumer, $this->signature);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->signature);
        unset($this->consumer);
        unset($this->httpAdapter);
        unset($this->oauth);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->httpAdapter, $this->oauth->getHttpAdapter());
        $this->assertSame($this->consumer, $this->oauth->getConsumer());
        $this->assertSame($this->signature, $this->oauth->getSignature());
        $this->assertSame('https://api.twitter.com/oauth', $this->oauth->getUrl());
        $this->assertSame('1.0', $this->oauth->getVersion());
    }

    public function testInitialState()
    {
        $this->oauth = new OAuth($this->httpAdapter, $this->consumer, $this->signature, 'https://my-url.com', '2.0');

        $this->assertSame('https://my-url.com', $this->oauth->getUrl());
        $this->assertSame('2.0', $this->oauth->getVersion());
    }

    public function testHttpAdapter()
    {
        $httpAdapter = $this->getMock('Widop\HttpAdapter\HttpAdapterInterface');
        $this->oauth->setHttpAdapter($httpAdapter);

        $this->assertSame($httpAdapter, $this->oauth->getHttpAdapter());
    }

    public function testConsumer()
    {
        $consumer = $this->getMockBuilder('Widop\Twitter\OAuth\OAuthConsumer')
            ->disableOriginalConstructor()
            ->getMock();

        $this->oauth->setConsumer($consumer);

        $this->assertSame($consumer, $this->oauth->getConsumer());
    }

    public function testSignature()
    {
        $signature = $this->getMock('Widop\Twitter\OAuth\Signature\OAuthSignatureInterface');
        $this->oauth->setSignature($signature);

        $this->assertSame($signature, $this->oauth->getSignature());
    }

    public function testUrl()
    {
        $this->oauth->setUrl('https://my-url.com');

        $this->assertSame('https://my-url.com', $this->oauth->getUrl());
    }

    public function testVersion()
    {
        $this->oauth->setVersion('2.0');

        $this->assertSame('2.0', $this->oauth->getVersion());
    }

    public function testSignRequestWithoutToken()
    {
        $request = $this->getMock('Widop\Twitter\OAuth\OAuthRequest');
        $request
            ->expects($this->once())
            ->method('setOAuthParameters')
            ->with($this->equalTo(array(
                'oauth_version'          => '1.0',
                'oauth_consumer_key'     => 'consumer_key',
                'oauth_signature_method' => 'signature-name',
                'oauth_signature'        => 'signature',
            )));

        $this->oauth->signRequest($request);
    }

    public function testSignRequestWithToken()
    {
        $request = $this->getMock('Widop\Twitter\OAuth\OAuthRequest');
        $request
            ->expects($this->once())
            ->method('setOAuthParameters')
            ->with($this->equalTo(array(
                'oauth_version'          => '1.0',
                'oauth_consumer_key'     => 'consumer_key',
                'oauth_signature_method' => 'signature-name',
                'oauth_token'            => 'token_key',
                'oauth_signature'        => 'signature',
            )));

        $token = $this->getMockBuilder('Widop\Twitter\OAuth\OAuthToken')
            ->disableOriginalConstructor()
            ->getMock();

        $token
            ->expects($this->once())
            ->method('getKey')
            ->will($this->returnValue('token_key'));

        $token
            ->expects($this->once())
            ->method('getSecret')
            ->will($this->returnValue('token_secret'));

        $this->oauth->signRequest($request, $token);
    }

    public function testGetRequestTokenWithoutCallback()
    {
        $this->httpAdapter
            ->expects($this->once())
            ->method('postContent')
            ->with(
                $this->equalTo('https://api.twitter.com/oauth/request_token'),
                $this->callback(function($headers) {
                    try {
                        \PHPUnit_Framework_Assert::assertArrayHasKey('Authorization', $headers);
                        \PHPUnit_Framework_Assert::assertRegExp(
                            '#OAuth oauth_callback="oob", oauth_version="1.0", oauth_consumer_key="consumer_key", oauth_signature_method="signature-name", oauth_signature="signature", oauth_nonce="(.*)", oauth_timestamp="(.*)"#',
                            $headers['Authorization']
                        );

                        return true;
                    } catch (\Exception $e) {
                        return false;
                    }
                })
            )
            ->will($this->returnValue('oauth_token=token_key&oauth_token_secret=token_secret'));

        $token = $this->oauth->getRequestToken();

        $this->assertInstanceOf('Widop\Twitter\OAuth\OAuthToken', $token);
        $this->assertSame('token_key', $token->getKey());
        $this->assertSame('token_secret', $token->getSecret());
    }

    public function testGetRequestTokenWithCallback()
    {
        $this->httpAdapter
            ->expects($this->once())
            ->method('postContent')
            ->with(
                $this->equalTo('https://api.twitter.com/oauth/request_token'),
                $this->callback(function($headers) {
                    try {
                        \PHPUnit_Framework_Assert::assertArrayHasKey('Authorization', $headers);
                        \PHPUnit_Framework_Assert::assertRegExp(
                            '#OAuth oauth_callback="http%3A%2F%2Fmy-url.com%2Fcallback", oauth_version="1.0", oauth_consumer_key="consumer_key", oauth_signature_method="signature-name", oauth_signature="signature", oauth_nonce="(.*)", oauth_timestamp="(.*)"#',
                            $headers['Authorization']
                        );

                        return true;
                    } catch (\Exception $e) {
                        return false;
                    }
                })
            )
            ->will($this->returnValue('oauth_token=token_key&oauth_token_secret=token_secret'));

        $token = $this->oauth->getRequestToken('http://my-url.com/callback');

        $this->assertInstanceOf('Widop\Twitter\OAuth\OAuthToken', $token);
        $this->assertSame('token_key', $token->getKey());
        $this->assertSame('token_secret', $token->getSecret());
    }

    public function testGetAuthorizeUrl()
    {
        $token = $this->getMockBuilder('Widop\Twitter\OAuth\OAuthToken')
            ->disableOriginalConstructor()
            ->getMock();

        $token
            ->expects($this->once())
            ->method('getKey')
            ->will($this->returnValue('token_key'));

        $this->assertSame(
            'https://api.twitter.com/oauth/authorize?oauth_token=token_key',
            $this->oauth->getAutorizeUrl($token)
        );
    }

    public function testGetAccessToken()
    {
        $this->httpAdapter
            ->expects($this->once())
            ->method('postContent')
            ->with(
                $this->equalTo('https://api.twitter.com/oauth/access_token'),
                $this->callback(function($headers) {
                    try {
                        \PHPUnit_Framework_Assert::assertArrayHasKey('Authorization', $headers);
                        \PHPUnit_Framework_Assert::assertRegExp(
                            '#OAuth oauth_verifier="oauth_verifier", oauth_version="1.0", oauth_consumer_key="consumer_key", oauth_signature_method="signature-name", oauth_signature="signature", oauth_nonce="(.*)", oauth_timestamp="(.*)"#',
                            $headers['Authorization']
                        );

                        return true;
                    } catch (\Exception $e) {
                        return false;
                    }
                })
            )
            ->will($this->returnValue('oauth_token=token_key&oauth_token_secret=token_secret'));

        $token = $this->oauth->getAccessToken('oauth_verifier');

        $this->assertInstanceOf('Widop\Twitter\OAuth\OAuthToken', $token);
        $this->assertSame('token_key', $token->getKey());
        $this->assertSame('token_secret', $token->getSecret());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage An error occured when creating the OAuth token. (foo)
     */
    public function testTokenError()
    {
        $this->httpAdapter
            ->expects($this->once())
            ->method('postContent')
            ->will($this->returnValue('foo'));

        $this->oauth->getRequestToken();
    }
}
