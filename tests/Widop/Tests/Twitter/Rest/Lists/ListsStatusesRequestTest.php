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

use Widop\Twitter\Rest\Lists\ListsStatusesRequest;

/**
 * Lists statuses request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class ListsStatusesRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Lists\ListsStatusesRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new ListsStatusesRequest();
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
        $this->assertNull($this->request->getListId());
        $this->assertNull($this->request->getSlug());
        $this->assertNull($this->request->getOwnerId());
        $this->assertNull($this->request->getOwnerScreenName());
        $this->assertNull($this->request->getCount());
        $this->assertNull($this->request->getSinceId());
        $this->assertNull($this->request->getMaxId());
        $this->assertNull($this->request->getIncludeEntities());
        $this->assertNull($this->request->getIncludeRts());
    }

    public function testListId()
    {
        $this->request->setListId('123456789');

        $this->assertSame('123456789', $this->request->getListId());
    }

    public function testSlug()
    {
        $this->request->setSlug('sandwich');

        $this->assertSame('sandwich', $this->request->getSlug());
    }

    public function testOwnerId()
    {
        $this->request->setOwnerId('123456789');

        $this->assertSame('123456789', $this->request->getOwnerId());
    }

    public function testOwnerScreenName()
    {
        $this->request->setOwnerScreenName('noradio');

        $this->assertSame('noradio', $this->request->getOwnerScreenName());
    }

    public function testSinceId()
    {
        $this->request->setSinceId('0123456789');

        $this->assertSame('0123456789', $this->request->getSinceId());
    }

    public function testCount()
    {
        $this->request->setCount(20);

        $this->assertSame(20, $this->request->getCount());
    }

    public function testMaxId()
    {
        $this->request->setMaxId('0123456789');

        $this->assertSame('0123456789', $this->request->getMaxId());
    }

    public function testIncludeEntities()
    {
        $this->request->setIncludeEntities(true);

        $this->assertTrue($this->request->getIncludeEntities());
    }

    public function testIncludeRts()
    {
        $this->request->setIncludeRts(true);

        $this->assertTrue($this->request->getIncludeRts());
    }

    public function testOAuthRequestWithListId()
    {
        $expected = array(
            'list_id'          => '123456789',
            'max_id'           => '123456',
            'count'            => '200',
            'include_entities' => 'true',
            'include_rts'      => 'false'
        );
        $this->request->setListId('123456789');
        $this->request->setCount(200);
        $this->request->setMaxId('123456');
        $this->request->setIncludeEntities(true);
        $this->request->setIncludeRts(false);
        $oauthRequest = $this->request->createOAuthRequest();
        $this->assertSame('/lists/statuses.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getGetParameters());
    }

    public function testOAuthRequestWithSlugAndOwnerId()
    {
        $expected = array(
            'slug'             => 'sandwich',
            'owner_id'         => '123456789',
            'since_id'         => '123456',
            'count'            => '200',
            'include_entities' => 'true',
            'include_rts'      => 'false'
        );
        $this->request->setSlug('sandwich');
        $this->request->setOwnerId('123456789');
        $this->request->setCount(200);
        $this->request->setSinceId('123456');
        $this->request->setIncludeEntities(true);
        $this->request->setIncludeRts(false);
        $oauthRequest = $this->request->createOAuthRequest();
        $this->assertSame($expected, $oauthRequest->getGetParameters());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a list id or slug.
     */
    public function testOAuthRequestWithoutParameters()
    {
        $this->request->createOAuthRequest();
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide the owner screen name or id in conjuction with the slug parameter.
     */
    public function testOAuthRequestWithSlugOnly()
    {
        $this->request->setSlug('sandwich');
        $this->request->createOAuthRequest();
    }
}
