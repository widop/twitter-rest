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

use Widop\Twitter\Rest\Lists\ListsMembersCreateAllRequest;

/**
 * Lists members create all request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class ListsMembersCreateAllRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Lists\ListsMembersCreateAllRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new ListsMembersCreateAllRequest();
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
        $this->request->setUserId('0123456789,456789');

        $this->assertSame('0123456789,456789', $this->request->getUserId());
    }

    public function testScreenName()
    {
        $this->request->setScreenName('noradio,twitterapi');

        $this->assertSame('noradio,twitterapi', $this->request->getScreenName());
    }

    public function testOAuthRequestWithListId()
    {
        $expected = array(
            'list_id' => '123456789',
            'user_id' => '1234567%2C987654'
        );
        $this->request->setListId('123456789');
        $this->request->setUserId('1234567,987654');
        $oauthRequest = $this->request->createOAuthRequest();
        $this->assertSame('/lists/members/create_all.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getPostParameters());
    }

    public function testOAuthRequestWithSlugAndOwnerId()
    {
        $this->request->setSlug('sandwich');
        $this->request->setOwnerId('123456789');
        $this->request->setScreenName('noradio,twitter');
        $expected = array(
            'slug'        => 'sandwich',
            'screen_name' => 'noradio%2Ctwitter',
            'owner_id'    => '123456789',
        );
        $oauthRequest = $this->request->createOAuthRequest();
        $this->assertSame($expected, $oauthRequest->getPostParameters());
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
     * @expectedExceptionMessage You must provide a user id or a screen name.
     */
    public function testOAuthRequestWithoutUserIdOrScreenName()
    {
        $this->request->setListId('123456789');
        $this->request->createOAuthRequest();
    }
}
