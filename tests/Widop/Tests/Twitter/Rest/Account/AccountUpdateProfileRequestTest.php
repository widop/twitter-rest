<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Rest\Account;

use Widop\Twitter\Rest\Account\AccountUpdateProfileRequest;

/**
 * Account update profile request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class AccountUpdateProfileRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Account\AccountUpdateProfileRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new AccountUpdateProfileRequest();
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

        $this->assertNull($this->request->getName());
        $this->assertNull($this->request->getUrl());
        $this->assertNull($this->request->getDescription());
        $this->assertNull($this->request->getLocation());
        $this->assertNull($this->request->getIncludeEntities());
        $this->assertNull($this->request->getSkipStatus());
    }

    public function testName()
    {
        $this->request->setName('foo');

        $this->assertSame('foo', $this->request->getName());
    }

    public function testUrl()
    {
        $this->request->setUrl('foo');

        $this->assertSame('foo', $this->request->getUrl());
    }

    public function testLocation()
    {
        $this->request->setLocation('foo');

        $this->assertSame('foo', $this->request->getLocation());
    }

    public function testDescription()
    {
        $this->request->setDescription('foo');

        $this->assertSame('foo', $this->request->getDescription());
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

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a either a name, description, url or a location.
     */
    public function testOAuthRequestWithoutColors()
    {
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/account/update_profile.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertEmpty($oauthRequest->getPostParameters());
    }

    public function testOAuthRequest()
    {
        $this->request->setName('foo');
        $this->request->setIncludeEntities(true);
        $this->request->setSkipStatus(true);
        $expected = array(
            'name'             => 'foo',
            'include_entities' => '1',
            'skip_status'      => '1',
        );
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/account/update_profile.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getPostParameters());
    }
}
