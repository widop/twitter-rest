<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Rest\Application;

use Widop\Twitter\Rest\Application\ApplicationRateLimitStatusRequest;

/**
 * Application rate limit status request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class ApplicationRateLimitStatusRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Application\ApplicationRateLimitStatusRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new ApplicationRateLimitStatusRequest();
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
        $this->assertNull($this->request->getResources());
    }

    public function testResources()
    {
        $this->request->setResources('statuses,friends');

        $this->assertSame('statuses,friends', $this->request->getResources());
    }

    public function testOAuthRequest()
    {
        $this->request->setResources('statuses,friends');
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/application/rate_limit_status.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertSame(array('resources' => 'statuses%2Cfriends'), $oauthRequest->getGetParameters());
    }
}
