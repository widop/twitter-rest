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

use Widop\Twitter\Rest\Users\UsersReportSpamRequest;

/**
 * Users report spam request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class UsersReportSpamRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Users\UsersReportSpamRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new UsersReportSpamRequest();
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
        $this->assertSame('/users/spam_report.json', $oauthRequest->getPath());
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
