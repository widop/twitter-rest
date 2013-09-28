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

use Widop\Twitter\OAuth\OAuthToken;

/**
 * OAuth token test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OAuthTokenTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\OAuth\OAuthToken */
    private $token;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->token = new OAuthToken('key', 'secret');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->token);
    }

    public function testInitialState()
    {
        $this->assertSame('key', $this->token->getKey());
        $this->assertSame('secret', $this->token->getSecret());
    }

    public function testKey()
    {
        $this->token->setKey('foo');

        $this->assertSame('foo', $this->token->getKey());
    }

    public function testSecret()
    {
        $this->token->setSecret('foo');

        $this->assertSame('foo', $this->token->getSecret());
    }
}
