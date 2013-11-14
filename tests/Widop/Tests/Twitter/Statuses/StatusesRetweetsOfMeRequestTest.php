<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Statuses;

use Widop\Twitter\Statuses\StatusesRetweetsOfMeRequest;

/**
 * Statuses retweets of me request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class StatusesRetweetsOfMeRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Statuses\StatusesRetweetsOfMeRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new StatusesRetweetsOfMeRequest();
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
        $this->assertInstanceOf('Widop\Twitter\Statuses\AbstractTimelineRequest', $this->request);
        $this->assertSame('/statuses/retweets_of_me.json', $this->request->getPath());
        $this->assertSame('GET', $this->request->getMethod());

        $this->assertNull($this->request->getCount());
        $this->assertNull($this->request->getSinceId());
        $this->assertNull($this->request->getMaxId());
        $this->assertNull($this->request->getTrimUser());
        $this->assertNull($this->request->getIncludeEntities());
        $this->assertNull($this->request->getIncludeUserEntities());
    }

    public function testSinceId()
    {
        $this->request->setSinceId('0123456789');

        $this->assertSame('0123456789', $this->request->getSinceId());
    }

    public function testCount()
    {
        $this->request->setCount(20);

        $this->assertSame(20, $this->request->getCount());
    }

    public function testMaxId()
    {
        $this->request->setMaxId('0123456789');

        $this->assertSame('0123456789', $this->request->getMaxId());
    }

    public function testTrimUser()
    {
        $this->request->setTrimUser(true);

        $this->assertTrue($this->request->getTrimUser());
    }


    public function testIncludeEntities()
    {
        $this->request->setIncludeEntities(true);

        $this->assertTrue($this->request->getIncludeEntities());
    }

    public function testIncludeUserEntities()
    {
        $this->request->setIncludeUserEntities(true);

        $this->assertTrue($this->request->getIncludeUserEntities());
    }

    public function testSignatureUrl()
    {
        $this->request->setBaseUrl('https://api.twitter.com/1.1');

        $this->assertSame('https://api.twitter.com/1.1/statuses/retweets_of_me.json', $this->request->getSignatureUrl());
    }

    public function testGetGetParameters()
    {
        $this->request->setSinceId('0123456789');
        $this->request->setCount(50);
        $this->request->setMaxId('9876543210');
        $this->request->setTrimUser(true);
        $this->request->setIncludeEntities(true);
        $this->request->setIncludeUserEntities(true);

        $expected = array(
            'include_entities'      => '1',
            'include_user_entities' => '1',
            'count'                 => '50',
            'since_id'              => '0123456789',
            'max_id'                => '9876543210',
            'trim_user'             => '1',
        );

        $this->assertSame($expected, $this->request->getGetParameters());
    }
}
