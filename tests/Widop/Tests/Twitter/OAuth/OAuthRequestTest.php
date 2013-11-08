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

use Widop\Twitter\OAuth\OAuthRequest;

/**
 * OAuth request test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OAuthRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\OAuth\OAuthRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new OAuthRequest();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->request);
    }

    public function testBaseUrl()
    {
        $this->request->setBaseUrl('https://api.twitter.com/oauth');

        $this->assertSame('https://api.twitter.com/oauth', $this->request->getBaseUrl());
    }

    public function testPath()
    {
        $this->request->setPath('/statuses/show.json');

        $this->assertSame('/statuses/show.json', $this->request->getPath());
    }

    public function testMethod()
    {
        $this->request->setMethod('post');

        $this->assertSame('POST', $this->request->getMethod());
    }

    public function testGetOAuthParameters()
    {
        $now = time();
        $oauthParameters = $this->request->getOAuthParameters();

        $this->assertCount(2, $oauthParameters);

        $this->assertArrayHasKey('oauth_nonce', $oauthParameters);
        $this->assertNotEmpty($oauthParameters['oauth_nonce']);

        $this->assertArrayHasKey('oauth_timestamp', $oauthParameters);
        $this->assertGreaterThanOrEqual($now, $oauthParameters['oauth_timestamp']);
        $this->assertLessThanOrEqual(time(), $oauthParameters['oauth_timestamp']);
    }

    public function testSetOAuthParameters()
    {
        $defaultOAuthParameters = array('oauth_token' => 'oauth_token');
        $this->request->setOAuthParameters($defaultOAuthParameters);

        $oauthParameters = $this->request->getOAuthParameters();

        $this->assertArrayHasKey('oauth_nonce', $oauthParameters);
        $this->assertArrayHasKey('oauth_timestamp', $oauthParameters);
        $this->assertArrayHasKey('oauth_token', $oauthParameters);

        $this->assertSame('oauth_token', $oauthParameters['oauth_token']);
    }

    public function testGetOauthParameter()
    {
        $this->request->setOAuthParameter('oauth_token', 'oauth_token');

        $this->assertSame('oauth_token', $this->request->getOAuthParameter('oauth_token'));
    }

    public function testRemoveOAuthParameter()
    {
        $this->request->setOAuthParameter('oauth_token', 'oauth_token');

        $this->assertTrue($this->request->hasOAuthParameter('oauth_token'));

        $this->request->removeOAuthParameter('oauth_token');

        $this->assertFalse($this->request->hasOAuthParameter('oauth_token'));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The OAuth request parameter "foo" does not exist.
     */
    public function testGetOAuthParameterWithInvalidName()
    {
        $this->request->getOAuthParameter('foo');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The OAuth request parameter "foo" does not exist.
     */
    public function testRemoveOAuthParameterWithInvalidName()
    {
        $this->request->removeOAuthParameter('foo');
    }

    public function testGetHeadersWithoutOAuthParameters()
    {
        $this->assertFalse($this->request->hasHeaders());
        $this->assertEmpty($this->request->getHeaders());
    }

    public function testGetHeadersWithOAuthParameters()
    {
        $this->request->setOAuthParameter('oauth_token', 'oauth_token');

        $this->assertFalse($this->request->hasHeaders());

        $headers = $this->request->getHeaders();
        $this->assertArrayHasKey('Authorization', $headers);

        $this->assertRegExp(
            '#OAuth oauth_token="oauth_token", oauth_nonce="(.*)", oauth_timestamp="(.*)"#',
            $headers['Authorization']
        );

        $this->assertTrue($this->request->hasHeaders());
    }

    public function testSetHeaders()
    {
        $headers = array('Type-Content' => 'application/x-www-form-urlencoded');
        $this->request->setHeaders($headers);

        $this->assertSame($headers, $this->request->getHeaders());
    }

    public function testGetHeader()
    {
        $this->request->setHeader('Type-Content', 'application/x-www-form-urlencoded');

        $this->assertSame('application/x-www-form-urlencoded', $this->request->getHeader('Type-Content'));
    }

    public function testRemoveHeader()
    {
        $this->request->setHeader('Type-Content', 'application/x-www-form-urlencoded');

        $this->assertTrue($this->request->hasHeader('Type-Content'));

        $this->request->removeHeader('Type-Content');

        $this->assertFalse($this->request->hasHeader('Type-Content'));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The request header "foo" does not exist.
     */
    public function testGetHeaderWithInvalidName()
    {
        $this->request->getHeader('foo');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The request header "foo" does not exist.
     */
    public function testRemoveHeaderWithInvalidName()
    {
        $this->request->removeHeader('foo');
    }

    public function testGetPathParameters()
    {
        $this->assertFalse($this->request->hasPathParameters());
        $this->assertEmpty($this->request->getPathParameters());
    }

    public function testSetPathParameters()
    {
        $pathParameters = array(':id' => '123');
        $this->request->setPathParameters($pathParameters);

        $this->assertTrue($this->request->hasPathParameters());
        $this->assertSame($pathParameters, $this->request->getPathParameters());
    }

    public function testGetPathParameter()
    {
        $this->request->setPathParameter(':id', '123');

        $this->assertSame('123', $this->request->getPathParameter(':id'));
    }

    public function testRemovePathParameter()
    {
        $this->request->setPathParameter(':id', '123');

        $this->assertTrue($this->request->hasPathParameter(':id'));

        $this->request->removePathParameter(':id');

        $this->assertFalse($this->request->hasPathParameter(':id'));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The path request parameter "foo" does not exist.
     */
    public function testGetPathParameterWithInvalidName()
    {
        $this->request->getPathParameter('foo');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The path request parameter "foo" does not exist.
     */
    public function testRemovePathParameterWithInvalidName()
    {
        $this->request->removePathParameter('foo');
    }

    public function testGetGetParameters()
    {
        $this->assertFalse($this->request->hasGetParameters());
        $this->assertEmpty($this->request->getGetParameters());
    }

    public function testSetGetParameters()
    {
        $getParameters = array('id' => '123');
        $this->request->setGetParameters($getParameters);

        $this->assertTrue($this->request->hasGetParameters());
        $this->assertSame($getParameters, $this->request->getGetParameters());
    }

    public function testGetGetParameter()
    {
        $this->request->setGetParameter('id', '123');

        $this->assertSame('123', $this->request->getGetParameter('id'));
    }

    public function testRemoveGetParameter()
    {
        $this->request->setGetParameter('id', '123');

        $this->assertTrue($this->request->hasGetParameter('id'));

        $this->request->removeGetParameter('id');

        $this->assertFalse($this->request->hasGetParameter('id'));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The GET request parameter "foo" does not exist.
     */
    public function testGetGetParameterWithInvalidName()
    {
        $this->request->getGetParameter('foo');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The GET request parameter "foo" does not exist.
     */
    public function testRemoveGetParameterWithInvalidName()
    {
        $this->request->removeGetParameter('foo');
    }

    public function testGetPostParameters()
    {
        $this->assertFalse($this->request->hasPostParameters());
        $this->assertEmpty($this->request->getPostParameters());
    }

    public function testSetPostParameters()
    {
        $postParameters = array('id' => '123');
        $this->request->setPostParameters($postParameters);

        $this->assertTrue($this->request->hasPostParameters());
        $this->assertSame($postParameters, $this->request->getPostParameters());
    }

    public function testGetPostParameter()
    {
        $this->request->setPostParameter('id', '123');

        $this->assertSame('123', $this->request->getPostParameter('id'));
    }

    public function testRemovePostParameter()
    {
        $this->request->setPostParameter('id', '123');

        $this->assertTrue($this->request->hasPostParameter('id'));

        $this->request->removePostParameter('id');

        $this->assertFalse($this->request->hasPostParameter('id'));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The POST request parameter "foo" does not exist.
     */
    public function testGetPostParameterWithInvalidName()
    {
        $this->request->getPostParameter('foo');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The POST request parameter "foo" does not exist.
     */
    public function testRemovePostParameterWithInvalidName()
    {
        $this->request->removePostParameter('foo');
    }

    public function testGetFileParameters()
    {
        $this->assertFalse($this->request->hasFileParameters());
        $this->assertEmpty($this->request->getFileParameters());
    }

    public function testSetFileParameters()
    {
        $postParameters = array('file' => __FILE__);
        $this->request->setFileParameters($postParameters);

        $this->assertTrue($this->request->hasFileParameters());
        $this->assertSame($postParameters, $this->request->getFileParameters());
    }

    public function testGetFileParameter()
    {
        $this->request->setFileParameter('file', __FILE__);

        $this->assertSame(__FILE__, $this->request->getFileParameter('file'));
    }

    public function testRemoveFileParameter()
    {
        $this->request->setFileParameter('file', __FILE__);

        $this->assertTrue($this->request->hasFileParameter('file'));

        $this->request->removeFileParameter('file');

        $this->assertFalse($this->request->hasFileParameter('file'));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The file request parameter "foo" does not exist.
     */
    public function testGetFileParameterWithInvalidName()
    {
        $this->request->getFileParameter('foo');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The file request parameter "foo" does not exist.
     */
    public function testRemoveFileParameterWithInvalidName()
    {
        $this->request->removeFileParameter('foo');
    }

    public function testSignatureUrlWithoutPathParameters()
    {
        $this->request->setBaseUrl('https://api.twitter.com/oauth');
        $this->request->setPath('/statuses/show.json');

        $this->assertSame('https://api.twitter.com/oauth/statuses/show.json', $this->request->getSignatureUrl());
    }

    public function testSignatureUrlWithPathParameters()
    {
        $this->request->setBaseUrl('https://api.twitter.com/oauth');
        $this->request->setPath('/statuses/show/:id.json');
        $this->request->setPathParameter(':id', '123');

        $this->assertSame('https://api.twitter.com/oauth/statuses/show/123.json', $this->request->getSignatureUrl());
    }

    public function testUrlWithoutParameters()
    {
        $this->request->setBaseUrl('https://api.twitter.com/oauth');
        $this->request->setPath('/statuses/show.json');

        $this->assertSame('https://api.twitter.com/oauth/statuses/show.json', $this->request->getUrl());
    }

    public function testUrlWithPathParameters()
    {
        $this->request->setBaseUrl('https://api.twitter.com/oauth');
        $this->request->setPath('/statuses/show/:id.json');
        $this->request->setPathParameter(':id', '123');

        $this->assertSame('https://api.twitter.com/oauth/statuses/show/123.json', $this->request->getUrl());
    }

    public function testUrlWithGetParameters()
    {
        $this->request->setBaseUrl('https://api.twitter.com/oauth');
        $this->request->setPath('/statuses/show.json');
        $this->request->setGetParameters(array(
            'id'        => '123',
            'trim_user' => true,
        ));

        $this->assertSame(
            'https://api.twitter.com/oauth/statuses/show.json?id=123&trim_user=1',
            $this->request->getUrl()
        );
    }

    public function testUrlWithParameters()
    {
        $this->request->setBaseUrl('https://api.twitter.com/oauth');
        $this->request->setPath('/statuses/show/:id.json');
        $this->request->setPathParameter(':id', '123');
        $this->request->setGetParameter('trim_user', true);

        $this->assertSame(
            'https://api.twitter.com/oauth/statuses/show/123.json?trim_user=1',
            $this->request->getUrl()
        );
    }

    public function testSignatureWithoutFileParameters()
    {
        $this->request->setBaseUrl('https://api.twitter.com/oauth');
        $this->request->setPath('/statuses/show.json');
        $this->request->setMethod('POST');
        $this->request->setOAuthParameters(array(
            'oauth_nonce'     => 'abcde',
            'oauth_timestamp' => '1380373886',
            'oauth_version'   => '1.0',
            'oauth_token'     => 'oauth_token',
        ));
        $this->request->setGetParameters(array(
            'foo1' => '123',
            'bar2' => true,
        ));
        $this->request->setPostParameters(array(
            'foo2' => '321',
            'bar1' => false,
        ));

        $this->assertSame(
            'POST&https%3A%2F%2Fapi.twitter.com%2Foauth%2Fstatuses%2Fshow.json&bar1%3D%26bar2%3D1%26foo1%3D123%26foo2%3D321%26oauth_nonce%3Dabcde%26oauth_timestamp%3D1380373886%26oauth_token%3Doauth_token%26oauth_version%3D1.0',
            $this->request->getSignature()
        );
    }

    public function testSignatureWithFileParameters()
    {
        $this->request->setBaseUrl('https://api.twitter.com/oauth');
        $this->request->setPath('/statuses/show.json');
        $this->request->setMethod('POST');
        $this->request->setOAuthParameters(array(
            'oauth_nonce'     => 'abcde',
            'oauth_timestamp' => '1380373886',
            'oauth_version'   => '1.0',
            'oauth_token'     => 'oauth_token',
        ));
        $this->request->setFileParameter('file', __FILE__);

        $this->assertSame(
            'POST&https%3A%2F%2Fapi.twitter.com%2Foauth%2Fstatuses%2Fshow.json&oauth_nonce%3Dabcde%26oauth_timestamp%3D1380373886%26oauth_token%3Doauth_token%26oauth_version%3D1.0',
            $this->request->getSignature()
        );
    }
}
