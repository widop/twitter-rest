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

use Widop\Twitter\Rest\Friendships\FriendshipsCreateRequest;

/**
 * Friendships create request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class FriendshipsCreateRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Friendships\FriendshipsCreateRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new FriendshipsCreateRequest();
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
        $this->assertNull($this->request->getFollow());
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

    public function testFollow()
    {
        $this->request->setFollow(true);

        $this->assertTrue($this->request->getFollow());
    }

    public function testOAuthRequestWithParameters()
    {
        $this->request->setUserId('123456789');
        $this->request->setFollow(true);
        $oauthRequest = $this->request->createOAuthRequest();
        $expected = array(
            'user_id' => '123456789',
            'follow'  => 'true'
        );

        $this->assertSame('/friendships/create.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getPostParameters());
    }

    public function testOAuthRequestWithScreenName()
    {
        $this->request->setScreenName('noradio');
        $this->request->setFollow(true);

        $expected = array(
            'screen_name' => 'noradio',
            'follow'      => 'true'
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
