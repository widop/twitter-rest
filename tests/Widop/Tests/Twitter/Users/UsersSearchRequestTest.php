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

use Widop\Twitter\Users\UsersSearchRequest;

/**
 * Users search request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class UsersSearchRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Users\UsersSearchRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new UsersSearchRequest('@noradio');
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

        $this->assertSame('@noradio', $this->request->getQ());
        $this->assertNull($this->request->getPage());
        $this->assertNull($this->request->getCount());
        $this->assertNull($this->request->getIncludeEntities());
    }

    public function testQ()
    {
        $this->request->setQ('321');

        $this->assertSame('321', $this->request->getQ());
    }

    public function testPage()
    {
        $this->request->setPage(20);

        $this->assertSame(20, $this->request->getPage());
    }

    public function testCount()
    {
        $this->request->setCount(20);

        $this->assertSame(20, $this->request->getCount());
    }

    public function testIncludeEntities()
    {
        $this->request->setIncludeEntities(true);

        $this->assertTrue($this->request->getIncludeEntities());
    }

    public function testOAuthRequest()
    {
        $this->request->setCount(200);
        $this->request->setPage(10);
        $this->request->setIncludeEntities(true);

        $oauthRequest = $this->request->createOAuthRequest();

        $expected = array(
            'q'                => '%40noradio',
            'page'             => '10',
            'count'            => '200',
            'include_entities' => '1',
        );

        $this->assertSame('/users/search.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getGetParameters());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must specify a query.
     */
    public function testOAuthRequestWithoutQuery()
    {
        $this->request->setQ(null);

        $this->request->createOAuthRequest();
    }
}
