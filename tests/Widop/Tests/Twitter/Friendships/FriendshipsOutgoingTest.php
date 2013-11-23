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

use Widop\Twitter\Friendships\FriendshipsOutgoingRequest;

/**
 * Friendships Outgoing request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class FriendshipsOutgoingRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Friendships\FriendshipsOutgoingRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new FriendshipsOutgoingRequest();
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

        $this->assertNull($this->request->getCursor());
        $this->assertNull($this->request->getStringifyIds());
    }

    public function testCursor()
    {
        $this->request->setCursor('0123456789');

        $this->assertSame('0123456789', $this->request->getCursor());
    }

    public function testStringifyIds()
    {
        $this->request->setStringifyIds(true);

        $this->assertTrue($this->request->getStringifyIds());
    }

    public function testOAuthRequestWithoutParameters()
    {
        $this->assertEmpty($this->request->createOAuthRequest()->getGetParameters());
    }

    public function testOAuthRequestWithParameters()
    {
        $this->request->setCursor('123456789');
        $this->request->setStringifyIds(true);
        $oauthRequest = $this->request->createOAuthRequest();

        $expected = array(
            'cursor'        => '123456789',
            'stringify_ids' => '1'
        );

        $this->assertSame('/friendships/outgoing.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getGetParameters());
    }
}
