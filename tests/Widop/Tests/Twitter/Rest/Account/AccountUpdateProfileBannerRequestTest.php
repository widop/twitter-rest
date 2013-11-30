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

use Widop\Twitter\Rest\Account\AccountUpdateProfileBannerRequest;

/**
 * Account update profile banner request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class AccountUpdateProfileBannerRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Account\AccountUpdateProfileBannerRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new AccountUpdateProfileBannerRequest();
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

        $this->assertNull($this->request->getBanner());
        $this->assertNull($this->request->getWidth());
        $this->assertNull($this->request->getHeight());
        $this->assertNull($this->request->getOffsetLeft());
        $this->assertNull($this->request->getOffsetTop());
    }

    public function testBanner()
    {
        $this->request->setBanner('foo');

        $this->assertSame('foo', $this->request->getBanner());
    }

    public function testWidth()
    {
        $this->request->setWidth(200);

        $this->assertSame(200, $this->request->getWidth());
    }

    public function testHeight()
    {
        $this->request->setHeight(200);

        $this->assertSame(200, $this->request->getHeight());
    }

    public function testOffsetLeft()
    {
        $this->request->setOffsetLeft(200);

        $this->assertSame(200, $this->request->getOffsetLeft());
    }

    public function testOffsetTop()
    {
        $this->request->setOffsetTop(200);

        $this->assertSame(200, $this->request->getOffsetTop());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a banner.
     */
    public function testOAuthRequestWithoutBanner()
    {
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/account/update_profile_banner.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertEmpty($oauthRequest->getPostParameters());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide all the image parameters.
     */
    public function testOAuthRequestWithParametersWithoutWidth()
    {
        $this->request->setBanner('foo');
        $this->request->setHeight(200);
        $this->request->setOffsetLeft(200);
        $this->request->setOffsetTop(200);
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/account/update_profile_banner.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertEmpty($oauthRequest->getPostParameters());
    }

    public function testOAuthRequest()
    {
        $this->request->setBanner('foo');
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/account/update_profile_banner.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertSame(array('banner' => 'foo'), $oauthRequest->getPostParameters());
    }
}
