<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Account;

use Widop\Twitter\Account\AccountRemoveProfileBannerRequest;

/**
 * Account remove profile banner request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class AccountRemoveProfileBannerRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Account\AccountRemoveProfileBannerRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new AccountRemoveProfileBannerRequest();
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
    }

    public function testOAuthRequest()
    {
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/account/remove_profile_banner.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertEmpty($oauthRequest->getPostParameters());
    }
}
