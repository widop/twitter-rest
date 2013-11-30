<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Rest\Users;

use Widop\Twitter\Rest\Users\UsersProfileBannerRequest;

/**
 * Users profile banner request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class UsersProfileBannerRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Users\UsersProfileBannerRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new UsersProfileBannerRequest();
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

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a user id or a screen name.
     */
    public function testOAuthRequestWithoutUserId()
    {
        $this->request->createOAuthRequest();
    }

    public function testOAuthRequestWithUserId()
    {
        $this->request->setUserId('0123456789');

        $oauthRequest = $this->request->createOAuthRequest();
        $this->assertSame('/users/profile_banner.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertSame(array('user_id' => '0123456789'), $oauthRequest->getGetParameters());
    }

    public function testOAuthRequestWithScreenName()
    {
        $this->request->setScreenName('noradio');

        $oauthRequest = $this->request->createOAuthRequest();
        $this->assertSame(array('screen_name' => 'noradio'), $oauthRequest->getGetParameters());
    }
}
