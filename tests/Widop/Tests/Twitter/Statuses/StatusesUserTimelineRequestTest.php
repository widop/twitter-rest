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

use Widop\Twitter\Statuses\StatusesUserTimelineRequest;

/**
 * Statuses user timeline request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class StatusesUserTimelineRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Statuses\StatusesUserTimelineRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new StatusesUserTimelineRequest();
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
        $this->assertSame('/statuses/user_timeline.json', $this->request->getPath());
        $this->assertSame('GET', $this->request->getMethod());

        $this->assertNull($this->request->getUserId());
        $this->assertNull($this->request->getScreenName());
        $this->assertNull($this->request->getSinceId());
        $this->assertNull($this->request->getCount());
        $this->assertNull($this->request->getMaxId());
        $this->assertNull($this->request->getTrimUser());
        $this->assertNull($this->request->getExcludeReplies());
        $this->assertNull($this->request->getContributorDetails());
        $this->assertNull($this->request->getIncludeRts());
    }

    public function testUserId()
    {
        $this->request->setUserId('0123456789');

        $this->assertSame('0123456789', $this->request->getUserId());
    }

    public function testScreenName()
    {
        $this->request->setScreenName('0123456789');

        $this->assertSame('0123456789', $this->request->getScreenName());
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

    public function testExcludeReplies()
    {
        $this->request->setExcludeReplies(true);

        $this->assertTrue($this->request->getExcludeReplies());
    }

    public function testContributorDetails()
    {
        $this->request->setContributorDetails(true);

        $this->assertTrue($this->request->getContributorDetails());
    }

    public function testIncludeRts()
    {
        $this->request->setIncludeRts(true);

        $this->assertTrue($this->request->getIncludeRts());
    }

    public function testSignatureUrl()
    {
        $this->request->setBaseUrl('https://api.twitter.com/1.1');

        $this->assertSame('https://api.twitter.com/1.1/statuses/user_timeline.json', $this->request->getSignatureUrl());
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testGetGetParametersWithoutUserIdAndScreenName()
    {
        $this->request->getGetParameters();
    }

    public function testGetGetParametersWithParameters()
    {
        $this->request->setScreenName('foo');
        $this->request->setSinceId('0123456789');
        $this->request->setCount(50);
        $this->request->setMaxId('9876543210');
        $this->request->setTrimUser(true);
        $this->request->setExcludeReplies(true);
        $this->request->setContributorDetails(true);
        $this->request->setIncludeRts(true);

        $expected = array(
            'screen_name'         => 'foo',
            'since_id'            => '0123456789',
            'count'               => '50',
            'max_id'              => '9876543210',
            'trim_user'           => '1',
            'exclude_replies'     => '1',
            'contributor_details' => '1',
            'include_rts'         => '1',
        );

        $this->assertSame($expected, $this->request->getGetParameters());
    }

    public function testGetGetParametersWithUserId()
    {
        $this->request->setUserId('0123456789');

        $this->assertSame(array('user_id' => '0123456789'), $this->request->getGetParameters());
    }

    public function testGetGetParametersWithUserIdAndScreenName()
    {
        $this->request->setUserId('0123456789');
        $this->request->setScreenName('foo');

        $this->assertSame(array('user_id' => '0123456789'), $this->request->getGetParameters());
    }
}
