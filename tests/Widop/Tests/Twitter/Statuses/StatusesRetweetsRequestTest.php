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

use Widop\Twitter\Statuses\StatusesRetweetsRequest;

/**
 * Statuses retweets request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class StatusesRetweetsRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Statuses\StatusesRetweetsRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new StatusesRetweetsRequest('123');
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
        $this->assertSame('/statuses/retweets/:id.json', $this->request->getPath());
        $this->assertSame('GET', $this->request->getMethod());

        $this->assertSame('123', $this->request->getId());
        $this->assertNull($this->request->getTrimUser());
    }

    public function testId()
    {
        $this->request->setId('321');

        $this->assertSame('321', $this->request->getId());
    }

    public function testCount()
    {
        $this->request->setCount(50);

        $this->assertSame(50, $this->request->getCount());

    }

    public function testTrimUser()
    {
        $this->request->setTrimUser(true);

        $this->assertTrue($this->request->getTrimUser());
    }

    public function testSignatureUrl()
    {
        $this->request->setBaseUrl('https://api.twitter.com/oauth');

        $this->assertSame('https://api.twitter.com/oauth/statuses/retweets/123.json', $this->request->getSignatureUrl());
    }

    public function testGetGetParametersWithoutParameters()
    {
        $this->assertEmpty($this->request->getGetParameters());
    }

    public function testGetGetParametersWithParameters()
    {
        $this->request->setCount(50);
        $this->request->setTrimUser(true);

        $expected = array(
            'count'     => '50',
            'trim_user' => '1'
        );

        $this->assertSame($expected, $this->request->getGetParameters());
    }
}
