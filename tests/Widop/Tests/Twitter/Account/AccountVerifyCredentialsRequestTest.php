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

use Widop\Twitter\Account\AccountVerifyCredentialsRequest;

/**
 * Account verify credentials request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class AccountVerifyCredentialsRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Account\AccountVerifyCredentialsRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new AccountVerifyCredentialsRequest();
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

        $this->assertNull($this->request->getIncludeEntities());
        $this->assertNull($this->request->getSkipStatus());
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

    public function testOAuthRequest()
    {
        $this->request->setIncludeEntities(true);
        $this->request->setSkipStatus(true);
        $expected = array(
            'include_entities' => '1',
            'skip_status'      => '1',
        );
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/account/verify_credentials.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getGetParameters());
    }
}
