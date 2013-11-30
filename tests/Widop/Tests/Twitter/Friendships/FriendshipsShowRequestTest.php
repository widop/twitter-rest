<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Friendships;

use Widop\Twitter\Friendships\FriendshipsShowRequest;

/**
 * Friendships show request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class FriendshipsShowRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Friendships\FriendshipsShowRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new FriendshipsShowRequest();
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

        $this->assertNull($this->request->getSourceId());
        $this->assertNull($this->request->getSourceScreenName());
        $this->assertNull($this->request->getTargetId());
        $this->assertNull($this->request->getTargetScreenName());
    }

    public function testSourceId()
    {
        $this->request->setSourceId('0123456789');

        $this->assertSame('0123456789', $this->request->getSourceId());
    }

    public function testSourceScreenName()
    {
        $this->request->setSourceScreenName('noradio');

        $this->assertSame('noradio', $this->request->getSourceScreenName());
    }

    public function testTargetId()
    {
        $this->request->setTargetId('0123456789');

        $this->assertSame('0123456789', $this->request->getTargetId());
    }

    public function testTargetScreenName()
    {
        $this->request->setTargetScreenName('noradio');

        $this->assertSame('noradio', $this->request->getTargetScreenName());
    }

    public function testOAuthRequestWithUserId()
    {
        $this->request->setSourceId('123456789');
        $this->request->setTargetId('1234567890');
        $oauthRequest = $this->request->createOAuthRequest();

        $expected = array(
            'source_id' => '123456789',
            'target_id' => '1234567890',
        );

        $this->assertSame('/friendships/show.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getGetParameters());
    }

    public function testOAuthRequestWithScreenName()
    {
        $this->request->setSourceScreenName('raffi');
        $this->request->setTargetScreenName('noradio');

        $expected = array(
            'source_screen_name' => 'raffi',
            'target_screen_name' => 'noradio',
        );

        $this->assertSame($expected, $this->request->createOAuthRequest()->getGetParameters());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a source id or a source screen name.
     */
    public function testOAuthRequestWithoutSource()
    {
        $this->request->createOAuthRequest();
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a target id or a target screen name.
     */
    public function testOAuthRequestWithoutTarget()
    {
        $this->request->setSourceId('123456789');

        $this->request->createOAuthRequest();
    }
}
