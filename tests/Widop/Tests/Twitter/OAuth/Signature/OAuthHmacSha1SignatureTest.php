<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\OAuth\Signature;

use Widop\Twitter\OAuth\Signature\OAuthHmacSha1Signature;

/**
 * OAuth hmac sha1 signature test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OAuthHmacSha1SignatureTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\OAuth\Signature\OAuthHmacSha1Signature */
    private $signature;

    /** @var \Widop\Twitter\OAuth\OAuthRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = $this->getMock('Widop\Twitter\OAuth\OAuthRequest');
        $this->request
            ->expects($this->any())
            ->method('getSignature')
            ->will($this->returnValue('signature'));

        $this->signature = new OAuthHmacSha1Signature();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->request);
        unset($this->signature);
    }

    public function testName()
    {
        $this->assertSame('HMAC-SHA1', $this->signature->getName());
    }

    public function testGenarateWithoutOAuthToken()
    {
        $signature = $this->signature->generate($this->request, 'consumer_secret');

        $this->assertSame('B5PnZjrLOzUPjzjnRklJgzJcffc=', $signature);
    }

    public function testGenarateWithOAuthToken()
    {
        $signature = $this->signature->generate($this->request, 'consumer_secret', 'token_secret');

        $this->assertSame('MXwCFb4MOk4GZq2CuCyK7dSMQmw=', $signature);
    }
}
