<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Rest\Trends;

use Widop\Twitter\Rest\Trends\TrendsAvailableRequest;

/**
 * Trends available request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class TrendsAvailableRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Trends\TrendsAvailableRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new TrendsAvailableRequest();
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
    }

    public function testOAuthRequest()
    {
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/trends/available.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertEmpty($oauthRequest->getGetParameters());
    }
}
