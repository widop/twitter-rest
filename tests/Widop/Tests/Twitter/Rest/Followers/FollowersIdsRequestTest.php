<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Rest\Followers;

use Widop\Twitter\Rest\Followers\FollowersIdsRequest;

/**
 * Followers ids request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class FollowersIdsRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Followers\FollowersIdsRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new FollowersIdsRequest();
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
        $this->assertNull($this->request->getCursor());
        $this->assertNull($this->request->getStringifyIds());
        $this->assertNull($this->request->getCount());
    }

    public function testUserId()
    {
        $this->request->setUserId('123456789');

        $this->assertSame('123456789', $this->request->getUserId());
    }

    public function testScreenName()
    {
        $this->request->setScreenName('noradio');

        $this->assertSame('noradio', $this->request->getScreenName());
    }

    public function testCursor()
    {
        $this->request->setCursor('123456789');

        $this->assertSame('123456789', $this->request->getCursor());
    }

    public function testCount()
    {
        $this->request->setCount(20);

        $this->assertSame(20, $this->request->getCount());
    }

    public function testStringifyIds()
    {
        $this->request->setStringifyIds(true);

        $this->assertTrue($this->request->getStringifyIds());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a user id or a screen name.
     */
    public function testOAuthRequestWithoutParameters()
    {
        $this->request->createOAuthRequest();
    }

    public function testOAuthRequestWithParameters()
    {
        $this->request->setScreenName('noradio');
        $this->request->setCursor('9876543210');
        $this->request->setStringifyIds(true);
        $this->request->setCount(50);
        $oauthRequest = $this->request->createOAuthRequest();

        $expected = array(
            'screen_name'   => 'noradio',
            'cursor'        => '9876543210',
            'stringify_ids' => 'true',
            'count'         => '50',
        );

        $this->assertSame('/followers/ids.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getGetParameters());
    }

    public function testOAuthRequestWithUserId()
    {
        $this->request->setUserId('0123456789');
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame(array('user_id' => '0123456789'), $oauthRequest->getGetParameters());
    }

    public function testOAuthRequestWithUserIdAndScreenName()
    {
        $this->request->setUserId('0123456789');
        $this->request->setScreenName('foo');
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame(array('user_id' => '0123456789'), $oauthRequest->getGetParameters());
    }
}
