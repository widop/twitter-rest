<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter;

use Widop\Twitter\Twitter;

/**
 * Twitter test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class TwitterTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Twitter */
    private $twitter;

    /** @var \Widop\HttpAdapter\HttpAdapterInterface */
    private $httpAdapter;

    /** @var \Widop\Twitter\OAuth\OAuth */
    private $oauth;

    /** @var \Widop\Twitter\OAuth\OAuthToken */
    private $oauthToken;

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

        $this->oauthToken = $this->getMockBuilder('Widop\Twitter\OAuth\OAuthToken')
            ->disableOriginalConstructor()
            ->getMock();

        $this->twitter = new Twitter($this->oauth, $this->oauthToken);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->oauthToken);
        unset($this->oauth);
        unset($this->twitter);
    }

    public function testDefaultState()
    {
        $this->twitter = new Twitter($this->oauth);

        $this->assertSame($this->oauth, $this->twitter->getOAuth());
        $this->assertNull($this->twitter->getOAuthToken());
        $this->assertSame('https://api.twitter.com/1.1', $this->twitter->getUrl());
    }

    public function testInitialState()
    {
        $this->twitter = new Twitter($this->oauth, $this->oauthToken, 'https://my-url.com');

        $this->assertSame($this->oauth, $this->twitter->getOAuth());
        $this->assertSame($this->oauthToken, $this->twitter->getOAuthToken());
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

    public function testOAuthToken()
    {
        $oauthToken = $this->getMockBuilder('Widop\Twitter\OAuth\OAuthToken')
            ->disableOriginalConstructor()
            ->getMock();

        $this->twitter->setOAuthToken($oauthToken);

        $this->assertSame($oauthToken, $this->twitter->getOAuthToken());
    }

    public function testSendWithGetRequest()
    {
        $request = $this->getMock('Widop\Twitter\AbstractRequest');

        $request
            ->expects($this->once())
            ->method('setBaseUrl')
            ->with($this->equalTo('https://api.twitter.com/1.1'));

        $this->oauth
            ->expects($this->once())
            ->method('signRequest')
            ->with(
                $this->equalTo($request),
                $this->equalTo($this->oauthToken)
            );

        $request
            ->expects($this->any())
            ->method('getMethod')
            ->will($this->returnValue('GET'));

        $request
            ->expects($this->once())
            ->method('getUrl')
            ->will($this->returnValue('url'));

        $request
            ->expects($this->once())
            ->method('getHeaders')
            ->will($this->returnValue(array('headers')));

        $this->httpAdapter
            ->expects($this->once())
            ->method('getContent')
            ->with($this->equalTo('url'), $this->equalTo(array('headers')))
            ->will($this->returnValue('{"json":"valid"}'));

        $result = $this->twitter->send($request);

        $this->assertSame(array('json' => 'valid'), $result);
    }

    public function testSendWithPostRequest()
    {
        $request = $this->getMock('Widop\Twitter\AbstractRequest');

        $request
            ->expects($this->once())
            ->method('setBaseUrl')
            ->with($this->equalTo('https://api.twitter.com/1.1'));

        $this->oauth
            ->expects($this->once())
            ->method('signRequest')
            ->with(
                $this->equalTo($request),
                $this->equalTo($this->oauthToken)
            );

        $request
            ->expects($this->any())
            ->method('getMethod')
            ->will($this->returnValue('POST'));

        $request
            ->expects($this->once())
            ->method('getUrl')
            ->will($this->returnValue('url'));

        $request
            ->expects($this->once())
            ->method('getPostParameters')
            ->will($this->returnValue(array('post_parameters')));

        $request
            ->expects($this->once())
            ->method('getHeaders')
            ->will($this->returnValue(array('headers')));

        $this->httpAdapter
            ->expects($this->once())
            ->method('postContent')
            ->with(
                $this->equalTo('url'),
                $this->equalTo(array('headers')),
                $this->equalTo(array('post_parameters'))
            )
            ->will($this->returnValue('{"json":"valid"}'));

        $result = $this->twitter->send($request);

        $this->assertSame(array('json' => 'valid'), $result);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage The request method "DELETE" is not supported.
     */
    public function testSendWithUnsupportedRequest()
    {
        $request = $this->getMock('Widop\Twitter\AbstractRequest');
        $request
            ->expects($this->any())
            ->method('getMethod')
            ->will($this->returnValue('DELETE'));

        $this->twitter->send($request);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage The http response is not valid JSON.
     */
    public function testSendWithInvalidXmlResponse()
    {
        $request = $this->getMock('Widop\Twitter\AbstractRequest');
        $request
            ->expects($this->any())
            ->method('getMethod')
            ->will($this->returnValue('GET'));

        $request
            ->expects($this->once())
            ->method('getHeaders')
            ->will($this->returnValue(array()));

        $response = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<errors>
  <error code="34">Sorry, that page does not exist</error>
</errors>
EOF;

        $this->httpAdapter
            ->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue($response));

        $this->twitter->send($request);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage The http response is not valid JSON.
     */
    public function testSendWithInvalidJsonResponse()
    {
        $request = $this->getMock('Widop\Twitter\AbstractRequest');
        $request
            ->expects($this->any())
            ->method('getMethod')
            ->will($this->returnValue('GET'));

        $request
            ->expects($this->once())
            ->method('getHeaders')
            ->will($this->returnValue(array()));

        $this->httpAdapter
            ->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue('{"errors":[{"message":"Sorry, that page does not exist","code":34}]}'));

        $this->twitter->send($request);
    }
}
