<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Statuses;

use Widop\Twitter\Statuses\StatusesRetweetRequest;

/**
 * Statuses retweet request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class StatusesRetweetRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Statuses\StatusesRetweetRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new StatusesRetweetRequest('123');
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

        $this->assertSame('123', $this->request->getId());
        $this->assertNull($this->request->getTrimUser());
    }

    public function testId()
    {
        $this->request->setId('321');

        $this->assertSame('321', $this->request->getId());
    }

    public function testTrimUser()
    {
        $this->request->setTrimUser(true);

        $this->assertTrue($this->request->getTrimUser());
    }

    public function testOAuthRequest()
    {
        $this->request->setTrimUser(true);

        $oauthRequest = $this->request->createOAuthRequest();
        $oauthRequest->setBaseUrl('https://api.twitter.com/oauth');

        $expected = array('trim_user' => '1');

        $this->assertSame('/statuses/retweet/:id.json', $oauthRequest->getPath());
        $this->assertSame('https://api.twitter.com/oauth/statuses/retweet/123.json', $oauthRequest->getSignatureUrl());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertEquals($expected, $oauthRequest->getPostParameters());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide an id.
     */
    public function testOAuthRequestWithoutId()
    {
        $this->request->setId(null);

        $this->request->createOAuthRequest();
    }
}
