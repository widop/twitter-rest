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

use Widop\Twitter\Rest\Statuses\StatusesRetweetsOfMeRequest;

/**
 * Statuses retweets of me request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class StatusesRetweetsOfMeRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Statuses\StatusesRetweetsOfMeRequest */
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
        $this->assertInstanceOf('Widop\Twitter\Rest\Statuses\AbstractTimelineRequest', $this->request);

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

    public function testOAuthRequest()
    {
        $this->request->setSinceId('0123456789');
        $this->request->setCount(50);
        $this->request->setMaxId('9876543210');
        $this->request->setTrimUser(true);
        $this->request->setIncludeEntities(true);
        $this->request->setIncludeUserEntities(true);

        $oauthRequest = $this->request->createOAuthRequest();

        $expected = array(
            'include_entities'      => '1',
            'include_user_entities' => '1',
            'count'                 => '50',
            'since_id'              => '0123456789',
            'max_id'                => '9876543210',
            'trim_user'             => '1',
        );

        $this->assertSame('/statuses/retweets_of_me.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertEquals($expected, $oauthRequest->getGetParameters());
    }
}
