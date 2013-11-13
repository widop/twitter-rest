<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\DirectMessages;

use Widop\Twitter\DirectMessages\DirectMessagesSentRequest;

/**
 * Direct messages sent request test.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/direct_messages/sent
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class DirectMessagesRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\DirectMessages\DirectMessagesSentRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new DirectMessagesSentRequest();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->request);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf('Widop\Twitter\AbstractRequest', $this->request);
        $this->assertSame('/direct_messages/sent.json', $this->request->getPath());
        $this->assertSame('GET', $this->request->getMethod());

        $this->assertNull($this->request->getSinceId());
        $this->assertNull($this->request->getMaxId());
        $this->assertNull($this->request->getCount());
        $this->assertNull($this->request->getPage());
        $this->assertNull($this->request->getIncludeEntities());
    }

    public function testSinceId()
    {
        $this->request->setSinceId('0123456789');

        $this->assertSame('0123456789', $this->request->getSinceId());
    }

    public function testMaxId()
    {
        $this->request->setMaxId('0123456789');

        $this->assertSame('0123456789', $this->request->getMaxId());
    }

    public function testCount()
    {
        $this->request->setCount(20);

        $this->assertSame(20, $this->request->getCount());
    }

    public function testPage()
    {
        $this->request->setPage(20);

        $this->assertSame(20, $this->request->getPage());
    }

    public function testIncludeEntities()
    {
        $this->request->setIncludeEntities(true);

        $this->assertTrue($this->request->getIncludeEntities());
    }

    public function testGetGetParametersWithoutParameters()
    {
        $this->assertEmpty($this->request->getGetParameters());
    }

    public function testGetGetParametersWithParameters()
    {
        $this->request->setSinceId('0123456789');
        $this->request->setMaxId('9876543210');
        $this->request->setCount(50);
        $this->request->setPage(1);
        $this->request->setIncludeEntities(true);

        $expected = array(
            'since_id'         => '0123456789',
            'max_id'           => '9876543210',
            'count'            => '50',
            'page'             => '1',
            'include_entities' => '1',
        );

        $this->assertSame($expected, $this->request->getGetParameters());
    }
}
