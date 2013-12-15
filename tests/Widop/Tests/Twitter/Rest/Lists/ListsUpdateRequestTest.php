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

use Widop\Twitter\Rest\Lists\ListsUpdateRequest;

/**
 * Lists update request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class ListsUpdateRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Lists\ListsUpdateRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new ListsUpdateRequest();
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
        $this->assertNull($this->request->getName());
        $this->assertNull($this->request->getMode());
        $this->assertNull($this->request->getDescription());
    }

    public function testName()
    {
        $this->request->setName('kebab');

        $this->assertSame('kebab', $this->request->getName());
    }

    public function testMode()
    {
        $this->request->setMode('public');

        $this->assertSame('public', $this->request->getMode());
    }

    public function testDescription()
    {
        $this->request->setDescription('kebab');

        $this->assertSame('kebab', $this->request->getDescription());
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

    public function testOAuthRequestWithListId()
    {
        $expected = array(
            'list_id' => '123456789',
            'name'    => 'kebab'
        );
        $this->request->setListId('123456789');
        $this->request->setName('kebab');
        $oauthRequest = $this->request->createOAuthRequest();
        $this->assertSame('/lists/update.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getPostParameters());
    }

    public function testOAuthRequestWithSlugAndOwnerId()
    {
        $this->request->setSlug('sandwich');
        $this->request->setOwnerId('123456789');
        $this->request->setDescription('Awesome sandwiches');
        $expected = array(
            'slug'        => 'sandwich',
            'owner_id'    => '123456789',
            'description' => 'Awesome%20sandwiches'
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
     * @expectedExceptionMessage You must provide at least one parameter to update (name, mode, descrition).
     */
    public function testOAuthRequestWithoutParametersToUpdate()
    {
        $this->request->setListId('123456');
        $this->request->createOAuthRequest();
    }
}
