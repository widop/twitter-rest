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

use Widop\Twitter\OAuth\OAuthConsumer;

/**
 * OAuth consumer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OAuthConsumerTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\OAuth\OAuthConsumer */
    private $consumer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->consumer = new OAuthConsumer('key', 'secret');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->consumer);
    }

    public function testInitialState()
    {
        $this->assertSame('key', $this->consumer->getKey());
        $this->assertSame('secret', $this->consumer->getSecret());
    }

    public function testKey()
    {
        $this->consumer->setKey('foo');

        $this->assertSame('foo', $this->consumer->getKey());
    }

    public function testSecret()
    {
        $this->consumer->setSecret('foo');

        $this->assertSame('foo', $this->consumer->getSecret());
    }
}
