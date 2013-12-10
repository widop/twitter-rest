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

use Widop\Twitter\Rest\Account\AccountUpdateProfileImageRequest;

/**
 * Account update profile image request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class AccountUpdateProfileImageRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Account\AccountUpdateProfileImageRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new AccountUpdateProfileImageRequest();
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

        $this->assertNull($this->request->getImage());
        $this->assertNull($this->request->getIncludeEntities());
        $this->assertNull($this->request->getSkipStatus());
    }

    public function testImage()
    {
        $this->request->setImage('foo');

        $this->assertSame('foo', $this->request->getImage());
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
     * @expectedExceptionMessage You must provide an image.
     */
    public function testOAuthRequestWithoutColors()
    {
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/account/update_profile_image.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertEmpty($oauthRequest->getPostParameters());
    }

    public function testOAuthRequest()
    {
        $this->request->setImage('foo');
        $this->request->setIncludeEntities(true);
        $this->request->setSkipStatus(true);
        $expected = array(
            'image'            => 'foo',
            'include_entities' => 'true',
            'skip_status'      => 'true',
        );
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/account/update_profile_image.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getPostParameters());
    }
}
