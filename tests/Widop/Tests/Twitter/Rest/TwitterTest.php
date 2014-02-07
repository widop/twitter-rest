<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Rest;

use Widop\Twitter\Rest\Twitter;

/**
 * Twitter test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class TwitterTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Twitter */
    private $twitter;

    /** @var \Widop\HttpAdapter\HttpAdapterInterface */
    private $httpAdapter;

    /** @var \Widop\Twitter\OAuth\OAuth */
    private $oauth;

    /** @var \Widop\Twitter\OAuth\Token\TokenInterface */
    private $token;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->httpAdapter = $this->getMock('Widop\HttpAdapter\HttpAdapterInterface');

        $this->oauth = $this->getMockBuilder('Widop\Twitter\OAuth\OAuth')
            ->disableOriginalConstructor()
            ->getMock();

        $this->oauth
            ->expects($this->any())
            ->method('getHttpAdapter')
            ->will($this->returnValue($this->httpAdapter));

        $this->token = $this->getMock('Widop\Twitter\OAuth\Token\TokenInterface');

        $this->twitter = new Twitter($this->oauth);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->token);
        unset($this->oauth);
        unset($this->twitter);
    }

    public function testDefaultState()
    {
        $this->twitter = new Twitter($this->oauth);

        $this->assertSame($this->oauth, $this->twitter->getOAuth());
        $this->assertNull($this->twitter->getToken());
        $this->assertSame('https://api.twitter.com/1.1', $this->twitter->getUrl());
    }

    public function testInitialState()
    {
        $this->twitter = new Twitter($this->oauth, $this->token, 'https://my-url.com');

        $this->assertSame($this->oauth, $this->twitter->getOAuth());
        $this->assertSame($this->token, $this->twitter->getToken());
        $this->assertSame('https://my-url.com', $this->twitter->getUrl());
    }

    public function testUrl()
    {
        $this->twitter->setUrl('https://my-url.com');

        $this->assertSame('https://my-url.com', $this->twitter->getUrl());
    }

    public function testOAuth()
    {
        $oauth = $this->getMockBuilder('Widop\Twitter\OAuth\OAuth')
            ->disableOriginalConstructor()
            ->getMock();

        $this->twitter->setOAuth($oauth);

        $this->assertSame($oauth, $this->twitter->getOAuth());
    }

    public function testToken()
    {
        $token = $this->getMock('Widop\Twitter\OAuth\Token\TokenInterface');

        $this->twitter->setToken($token);

        $this->assertSame($token, $this->twitter->getToken());
    }

    public function testSend()
    {
        $oauthRequest = $this->getMock('Widop\Twitter\OAuth\OAuthRequest');

        $this->oauth
            ->expects($this->once())
            ->method('signRequest')
            ->with(
                $this->equalTo($oauthRequest),
                $this->equalTo($this->token)
            );

        $response = $this->getMockBuilder('Widop\Twitter\OAuth\OAuthResponse')
            ->disableOriginalConstructor()
            ->getMock();

        $this->oauth
            ->expects($this->once())
            ->method('sendRequest')
            ->with($this->identicalTo($oauthRequest))
            ->will($this->returnValue($response));

        $request = $this->getMockBuilder('Widop\Twitter\Rest\AbstractRequest')
            ->setMethods(array('createOAuthRequest'))
            ->getMockForAbstractClass();

        $request
            ->expects($this->once())
            ->method('createOAuthRequest')
            ->will($this->returnValue($oauthRequest));

        $this->twitter->setToken($this->token);

        $this->assertSame($response, $this->twitter->send($request));
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a token in order to send a request.
     */
    public function testSendWithoutToken()
    {
        $request = $this->getMockBuilder('Widop\Twitter\Rest\AbstractRequest')->getMockForAbstractClass();

        $this->twitter->send($request);
    }
}
