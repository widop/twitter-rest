<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Users;

use Widop\Twitter\Users\UsersLookupRequest;

/**
 * Users lookup request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class UsersLookupRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Users\UsersLookupRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new UsersLookupRequest();
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
        $this->assertNull($this->request->getIncludeEntities());
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

    public function testIncludeEntities()
    {
        $this->request->setIncludeEntities(true);

        $this->assertTrue($this->request->getIncludeEntities());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a series of user ids or screen names.
     */
    public function testOAuthRequestWithoutUserId()
    {
        $this->request->createOAuthRequest();
    }

    public function testOAuthRequestWithUserId()
    {
        $this->request->setUserId('0123456789');

        $oauthRequest = $this->request->createOAuthRequest();
        $this->assertSame('/users/lookup.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertSame(array('user_id' => '0123456789'), $oauthRequest->getPostParameters());
    }

    public function testOAuthRequestWithScreenName()
    {
        $this->request->setScreenName('noradio');

        $oauthRequest = $this->request->createOAuthRequest();
        $this->assertSame(array('screen_name' => 'noradio'), $oauthRequest->getPostParameters());
    }
}
