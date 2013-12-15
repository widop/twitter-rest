<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Rest\Lists;

use Widop\Twitter\Rest\Lists\ListsSubscriptionsRequest;

/**
 * Lists subscriptions request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class ListsSubscriptionsRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Lists\ListsSubscriptionsRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new ListsSubscriptionsRequest();
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
        $this->assertNull($this->request->getCount());
        $this->assertNull($this->request->getCursor());
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

    public function testCount()
    {
        $this->request->setCount(20);

        $this->assertSame(20, $this->request->getCount());
    }

    public function testCursor()
    {
        $this->request->setCursor('123456789');

        $this->assertSame('123456789', $this->request->getCursor());
    }

    public function testOAuthRequestWithUserId()
    {
        $expected = array(
            'user_id' => '123456789',
            'count'   => '100',
            'cursor'  => '-1',
        );
        $this->request->setUserId('123456789');
        $this->request->setCount(100);
        $this->request->setCursor('-1');
        $oauthRequest = $this->request->createOAuthRequest();
        $this->assertSame('/lists/subscriptions.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getGetParameters());
    }

    public function testOAuthRequestWithScreenName()
    {
        $expected = array(
            'screen_name' => 'noradio',
            'count'       => '100',
            'cursor'      => '-1',
        );
        $this->request->setScreenName('noradio');
        $this->request->setCount(100);
        $this->request->setCursor('-1');
        $oauthRequest = $this->request->createOAuthRequest();
        $this->assertSame($expected, $oauthRequest->getGetParameters());
    }
}
