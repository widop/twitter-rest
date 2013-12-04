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

use Widop\Twitter\Rest\Geo\GeoReverseGeocodeRequest;

/**
 * Geo reverse geocode request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class GeoReverseGeocodeRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Geo\GeoReverseGeocodeRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new GeoReverseGeocodeRequest('10.10', '-12.45');
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

        $this->assertSame('10.10', $this->request->getLat());
        $this->assertSame('-12.45', $this->request->getLong());
        $this->assertNull($this->request->getAccuracy());
        $this->assertNull($this->request->getGranularity());
        $this->assertNull($this->request->getMaxResults());
        $this->assertNull($this->request->getCallback());
    }

    public function testLat()
    {
        $this->request->setLat('37.2');

        $this->assertSame('37.2', $this->request->getLat());
    }

    public function testLong()
    {
        $this->request->setLong('-110.2');

        $this->assertSame('-110.2', $this->request->getLong());
    }

    public function testGranularity()
    {
        $this->request->setGranularity('city');

        $this->assertSame('city', $this->request->getGranularity());
    }

    public function testAccuracy()
    {
        $this->request->setAccuracy('5ft');

        $this->assertSame('5ft', $this->request->getAccuracy());
    }

    public function testMaxResults()
    {
        $this->request->setMaxResults(200);

        $this->assertSame(200, $this->request->getMaxResults());
    }

    public function testCallback()
    {
        $this->request->setCallback('myCallback');

        $this->assertSame('myCallback', $this->request->getCallback());
    }

    public function testOAuthRequestWithParameters()
    {
        $this->request->setGranularity('city');
        $this->request->setAccuracy('5ft');
        $this->request->setMaxResults(200);
        $this->request->setCallback('myCallback');
        $oauthRequest = $this->request->createOAuthRequest();
        $expected = array(
            'lat'         => '10.10',
            'long'        => '-12.45',
            'accuracy'    => '5ft',
            'granularity' => 'city',
            'max_results' => '200',
            'callback'    => 'myCallback'
        );

        $this->assertSame('/geo/reverse_geocode.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getGetParameters());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a latitude.
     */
    public function testOAuthRequestWithoutLatitude()
    {
        $this->request->setLat(null);
        $this->request->createOAuthRequest();
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a longitude.
     */
    public function testOAuthRequestWithoutLongitude()
    {
        $this->request->setLong(null);
        $this->request->createOAuthRequest();
    }
}
