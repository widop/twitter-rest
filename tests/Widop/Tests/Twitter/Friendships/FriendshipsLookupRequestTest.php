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

use Widop\Twitter\Friendships\FriendshipsLookupRequest;

/**
 * Friendships lookup request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class FriendshipsLookupRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Friendships\FriendshipsLookupRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new FriendshipsLookupRequest();
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

        $this->assertNull($this->request->getUserId());
        $this->assertNull($this->request->getScreenName());
    }

    public function testUserId()
    {
        $this->request->setUserId('0123456789');

        $this->assertSame('0123456789', $this->request->getUserId());
    }

    public function testScreenName()
    {
        $this->request->setScreenName('noradio');

        $this->assertSame('noradio', $this->request->getScreenName());
    }

    public function testOAuthRequestWithParameters()
    {
        $this->request->setUserId('123456789');
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/friendships/lookup.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertSame(array('user_id' => '123456789'), $oauthRequest->getGetParameters());
    }

    public function testOAuthRequestWithScreenName()
    {
        $this->request->setScreenName('noradio');

        $this->assertSame(array('screen_name' => 'noradio'), $this->request->createOAuthRequest()->getGetParameters());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must specify a user id or a screen name.
     */
    public function testOAuthRequestWithoutParameters()
    {
        $this->request->createOAuthRequest();
    }
}
