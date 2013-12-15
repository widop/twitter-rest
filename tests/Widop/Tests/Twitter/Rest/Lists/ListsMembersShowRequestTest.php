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

use Widop\Twitter\Rest\Lists\ListsMembersShowRequest;

/**
 * Lists members show request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class ListsMembersShowRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Lists\ListsMembersShowRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new ListsMembersShowRequest();
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
        $this->assertNull($this->request->getUserId());
        $this->assertNull($this->request->getScreenName());
        $this->assertNull($this->request->getIncludeEntities());
        $this->assertNull($this->request->getSkipStatus());
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

    public function testIncludeEntities()
    {
        $this->request->setIncludeEntities(true);

        $this->assertTrue($this->request->getIncludeEntities());
    }

    public function testSkipStatus()
    {
        $this->request->setSkipStatus(true);

        $this->assertTrue($this->request->getSkipStatus());
    }

    public function testOAuthRequestWithListId()
    {
        $expected = array(
            'list_id'          => '123456789',
            'user_id'          => '123456789',
            'include_entities' => 'false',
            'skip_status'      => 'true',
        );
        $this->request->setListId('123456789');
        $this->request->setUserId('123456789');
        $this->request->setIncludeEntities(false);
        $this->request->setSkipStatus(true);
        $oauthRequest = $this->request->createOAuthRequest();
        $this->assertSame('/lists/members/show.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertEquals($expected, $oauthRequest->getGetParameters());
    }

    public function testOAuthRequestWithSlugAndOwnerId()
    {
        $this->request->setSlug('sandwich');
        $this->request->setOwnerId('123456789');
        $this->request->setScreenName('noradio');
        $this->request->setIncludeEntities(false);
        $this->request->setSkipStatus(true);
        $expected = array(
            'slug'             => 'sandwich',
            'screen_name'      => 'noradio',
            'owner_id'         => '123456789',
            'include_entities' => 'false',
            'skip_status'      => 'true'
        );
        $oauthRequest = $this->request->createOAuthRequest();
        $this->assertEquals($expected, $oauthRequest->getGetParameters());
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

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a user id or screen name.
     */
    public function testOAuthRequestWithoutUserId()
    {
        $this->request->setListId('123456789');
        $this->request->createOAuthRequest();
    }
}
