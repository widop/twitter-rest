<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Rest\Statuses;

use Widop\Twitter\Rest\Statuses\StatusesHomeTimelineRequest;

/**
 * Statuses home timeline request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class StatusesHomeTimelineRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Statuses\StatusesHomeTimelineRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new StatusesHomeTimelineRequest();
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
        $this->assertInstanceOf('Widop\Twitter\Rest\Statuses\AbstractTimelineRequest', $this->request);

        $this->assertNull($this->request->getCount());
        $this->assertNull($this->request->getSinceId());
        $this->assertNull($this->request->getMaxId());
        $this->assertNull($this->request->getTrimUser());
        $this->assertNull($this->request->getExcludeReplies());
        $this->assertNull($this->request->getContributorDetails());
        $this->assertNull($this->request->getIncludeEntities());
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

    public function testIncludeEntities()
    {
        $this->request->setIncludeEntities(true);

        $this->assertTrue($this->request->getIncludeEntities());
    }

    public function testOAuthRequest()
    {
        $this->request->setSinceId('0123456789');
        $this->request->setCount(50);
        $this->request->setMaxId('9876543210');
        $this->request->setTrimUser(true);
        $this->request->setExcludeReplies(true);
        $this->request->setContributorDetails(true);
        $this->request->setIncludeEntities(true);

        $oauthRequest = $this->request->createOAuthRequest();
        $oauthRequest->setBaseUrl('https://api.twitter.com/1.1');

        $expected = array(
            'exclude_replies'     => '1',
            'contributor_details' => '1',
            'include_entities'    => '1',
            'count'               => '50',
            'since_id'            => '0123456789',
            'max_id'              => '9876543210',
            'trim_user'           => '1',
        );

        $this->assertSame('/statuses/home_timeline.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertEquals($expected, $oauthRequest->getGetParameters());
    }
}
