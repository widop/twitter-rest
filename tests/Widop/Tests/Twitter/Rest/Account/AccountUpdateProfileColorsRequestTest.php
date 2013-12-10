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

use Widop\Twitter\Rest\Account\AccountUpdateProfileColorsRequest;

/**
 * Account update profile colors request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class AccountUpdateProfileColorsRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Account\AccountUpdateProfileColorsRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new AccountUpdateProfileColorsRequest();
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

        $this->assertNull($this->request->getProfileBackgroundColor());
        $this->assertNull($this->request->getProfileLinkColor());
        $this->assertNull($this->request->getProfileSidebarBorderColor());
        $this->assertNull($this->request->getProfileSidebarFillColor());
        $this->assertNull($this->request->getProfileTextColor());
        $this->assertNull($this->request->getIncludeEntities());
        $this->assertNull($this->request->getSkipStatus());
    }

    public function testProfileBackgroundColor()
    {
        $this->request->setProfileBackgroundColor('00FF00');

        $this->assertSame('00FF00', $this->request->getProfileBackgroundColor());
    }

    public function testProfileLinkColor()
    {
        $this->request->setProfileLinkColor('00FF00');

        $this->assertSame('00FF00', $this->request->getProfileLinkColor());
    }

    public function testProfileSidebarBorderColor()
    {
        $this->request->setProfileSidebarBorderColor('00FF00');

        $this->assertSame('00FF00', $this->request->getProfileSidebarBorderColor());
    }

    public function testProfileSidebarFillColor()
    {
        $this->request->setProfileSidebarFillColor('00FF00');

        $this->assertSame('00FF00', $this->request->getProfileSidebarFillColor());
    }

    public function testProfileTextColor()
    {
        $this->request->setProfileTextColor('00FF00');

        $this->assertSame('00FF00', $this->request->getProfileTextColor());
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
     * @expectedExceptionMessage You must provide at least one color to update.
     */
    public function testOAuthRequestWithoutColors()
    {
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/account/update_profile_colors.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertEmpty($oauthRequest->getPostParameters());
    }

    public function testOAuthRequest()
    {
        $this->request->setProfileBackgroundColor('00FF00');
        $this->request->setIncludeEntities(true);
        $this->request->setSkipStatus(true);
        $expected = array(
            'profile_background_color' => '00FF00',
            'include_entities'         => 'true',
            'skip_status'              => 'true',
        );
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/account/update_profile_colors.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getPostParameters());
    }
}
