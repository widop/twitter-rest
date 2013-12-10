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

use Widop\Twitter\Rest\Followers\FollowersListRequest;

/**
 * Followers list request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class FollowersListRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Followers\FollowersListRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new FollowersListRequest();
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

    public function testSkipStatus()
    {
        $this->request->setSkipStatus(true);

        $this->assertTrue($this->request->getSkipStatus());
    }

    public function testIncludeUserEntities()
    {
        $this->request->setIncludeUserEntities(true);

        $this->assertTrue($this->request->getIncludeUserEntities());
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
        $this->request->setCount(50);
        $this->request->setSkipStatus(true);
        $this->request->setIncludeUserEntities(true);
        $oauthRequest = $this->request->createOAuthRequest();

        $expected = array(
            'screen_name'           => 'noradio',
            'cursor'                => '9876543210',
            'count'                 => '50',
            'skip_status'           => 'true',
            'include_user_entities' => 'true',
        );

        $this->assertSame('/followers/list.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getGetParameters());
    }

    public function testOAuthRequestWithUserId()
    {
        $this->request->setUserId('0123456789');

        $this->assertSame(array('user_id' => '0123456789'), $this->request->createOAuthRequest()->getGetParameters());
    }

    public function testOAuthRequestWithUserIdAndScreenName()
    {
        $this->request->setUserId('0123456789');
        $this->request->setScreenName('foo');

        $this->assertSame(array('user_id' => '0123456789'), $this->request->createOAuthRequest()->getGetParameters());
    }
}
