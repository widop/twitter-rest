<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Rest\Geo;

use Widop\Twitter\Rest\Geo\GeoIdPlaceIdRequest;

/**
 * Geo id place id request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class GeoIdPlaceIdRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Geo\GeoIdPlaceIdRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new GeoIdPlaceIdRequest('foo');
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

        $this->assertSame('foo', $this->request->getPlaceId());
    }

    public function testPlaceId()
    {
        $this->request->setPlaceId('bar');

        $this->assertSame('bar', $this->request->getPlaceId());
    }

    public function testOAuthRequest()
    {
        $oauthRequest = $this->request->createOAuthRequest();
        $oauthRequest->setBaseUrl('https://api.twitter.com/oauth');

        $this->assertSame('/geo/id/:place_id.json', $oauthRequest->getPath());
        $this->assertSame('https://api.twitter.com/oauth/geo/id/foo.json', $oauthRequest->getSignatureUrl());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertEmpty($oauthRequest->getGetParameters());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a place id.
     */
    public function testOAuthRequestWithoutPlaceIditude()
    {
        $this->request->setPlaceId(null);
        $this->request->createOAuthRequest();
    }
}
