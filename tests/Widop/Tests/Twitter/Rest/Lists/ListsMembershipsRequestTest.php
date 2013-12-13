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

use Widop\Twitter\Rest\Lists\ListsMembershipsRequest;

/**
 * Lists memberships request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class ListsMembershipsRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Lists\ListsMembershipsRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new ListsMembershipsRequest();
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
        $this->assertNull($this->request->getFilterToOwnedLists());
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

    public function testCursor()
    {
        $this->request->setCursor('123456789');

        $this->assertSame('123456789', $this->request->getCursor());
    }

    public function testFilterToOwnedLists()
    {
        $this->request->setFilterToOwnedLists(true);

        $this->assertTrue($this->request->getFilterToOwnedLists());
    }

    public function testOAuthRequestWithUserId()
    {
        $expected = array(
            'user_id'               => '123456789',
            'cursor'                => '-1',
            'filter_to_owned_lists' => 'true'
        );
        $this->request->setUserId('123456789');
        $this->request->setCursor('-1');
        $this->request->setFilterToOwnedLists(true);
        $oauthRequest = $this->request->createOAuthRequest();
        $this->assertSame('/lists/memberships.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getGetParameters());
    }

    public function testOAuthRequestWithScreenName()
    {
        $expected = array(
            'screen_name'           => 'noradio',
            'cursor'                => '-1',
            'filter_to_owned_lists' => 'true'
        );
        $this->request->setScreenName('noradio');
        $this->request->setCursor('-1');
        $this->request->setFilterToOwnedLists(true);
        $oauthRequest = $this->request->createOAuthRequest();
        $this->assertSame($expected, $oauthRequest->getGetParameters());
    }
}
