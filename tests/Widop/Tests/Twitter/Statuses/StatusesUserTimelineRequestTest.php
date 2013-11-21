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
        $this->assertInstanceOf('Widop\Twitter\Statuses\AbstractTimelineRequest', $this->request);

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

    public function testOAuthRequestWithUserId()
    {
        $this->request->setUserId('123');
        $this->request->setSinceId('0123456789');
        $this->request->setCount(50);
        $this->request->setMaxId('9876543210');
        $this->request->setTrimUser(true);
        $this->request->setExcludeReplies(true);
        $this->request->setContributorDetails(true);
        $this->request->setIncludeRts(true);

        $oauthRequest = $this->request->createOAuthRequest();

        $expected = array(
            'user_id'             => '123',
            'exclude_replies'     => '1',
            'contributor_details' => '1',
            'include_rts'         => '1',
            'count'               => '50',
            'since_id'            => '0123456789',
            'max_id'              => '9876543210',
            'trim_user'           => '1',
        );

        $this->assertSame('/statuses/user_timeline.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertEquals($expected, $oauthRequest->getGetParameters());
    }

    public function testOAuthRequestWithScreeName()
    {
        $this->request->setUserId('0123456789');

        $expected = array('user_id' => '0123456789');

        $this->assertEquals($expected, $this->request->createOAuthRequest()->getGetParameters());
    }

    public function testOAuthRequestWithUserIdAndScreenName()
    {
        $this->request->setUserId('0123456789');
        $this->request->setScreenName('foo');

        $expected = array('user_id' => '0123456789');

        $this->assertEquals($expected, $this->request->createOAuthRequest()->getGetParameters());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must specify a user id or a screen name.
     */
    public function testOAuthRequestWithoutUserIdAndScreenName()
    {
        $this->request->createOAuthRequest();
    }
}
