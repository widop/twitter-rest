<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Rest\Friendships;

use Widop\Twitter\Rest\Friendships\FriendshipsUpdateRequest;

/**
 * Friendships update request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class FriendshipsUpdateRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Friendships\FriendshipsUpdateRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new FriendshipsUpdateRequest();
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
        $this->assertInstanceOf('Widop\Twitter\Rest\AbstractRequest', $this->request);

        $this->assertNull($this->request->getUserId());
        $this->assertNull($this->request->getScreenName());
        $this->assertNull($this->request->getDevice());
        $this->assertNull($this->request->getRetweets());
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

    public function testDevice()
    {
        $this->request->setDevice(true);

        $this->assertTrue($this->request->getDevice());
    }

    public function testRetweets()
    {
        $this->request->setRetweets(true);

        $this->assertTrue($this->request->getRetweets());
    }

    public function testOAuthRequestWithParameters()
    {
        $this->request->setUserId('123456789');
        $this->request->setDevice(true);
        $this->request->setRetweets(true);
        $oauthRequest = $this->request->createOAuthRequest();

        $expected = array(
            'user_id'  => '123456789',
            'device'   => 'true',
            'retweets' => 'true'
        );

        $this->assertSame('/friendships/update.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getPostParameters());
    }

    public function testOAuthRequestWithScreenName()
    {
        $this->request->setScreenName('noradio');
        $this->request->setDevice(true);
        $this->request->setRetweets(true);

        $expected = array(
            'screen_name' => 'noradio',
            'device'      => 'true',
            'retweets'    => 'true'
        );

        $this->assertSame($expected, $this->request->createOAuthRequest()->getPostParameters());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a user id or a screen name.
     */
    public function testOAuthRequestWithoutParameters()
    {
        $this->request->createOAuthRequest();
    }
}
