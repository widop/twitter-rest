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

use Widop\Twitter\Rest\Geo\GeoSearchRequest;

/**
 * Geo search request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class GeoSearchRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Geo\GeoSearchRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new GeoSearchRequest();
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

        $this->assertNull($this->request->getLat());
        $this->assertNull($this->request->getLong());
        $this->assertNull($this->request->getQuery());
        $this->assertNull($this->request->getIp());
        $this->assertNull($this->request->getGranularity());
        $this->assertNull($this->request->getAccuracy());
        $this->assertNull($this->request->getMaxResults());
        $this->assertNull($this->request->getContainedWithin());
        $this->assertNull($this->request->getAttribute_StreetAddress());
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

    public function testIp()
    {
        $this->request->setIp('10.10.10.10');

        $this->assertSame('10.10.10.10', $this->request->getIp());
    }

    public function testQuery()
    {
        $this->request->setQuery('Twitter HQ');

        $this->assertSame('Twitter HQ', $this->request->getQuery());
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

    public function testContainedWithin()
    {
        $this->request->setContainedWithin('247f43d441defc03');

        $this->assertSame('247f43d441defc03', $this->request->getContainedWithin());
    }

    public function testAttributeStreetAddress()
    {
        $this->request->setAttribute_StreetAddress('79 Folsom St');

        $this->assertSame('79 Folsom St', $this->request->getAttribute_StreetAddress());
    }

    public function testCallback()
    {
        $this->request->setCallback('myCallback');

        $this->assertSame('myCallback', $this->request->getCallback());
    }

    public function testOAuthRequestWithParameters()
    {
        $this->request->setQuery('Twitter HQ');
        $this->request->setGranularity('city');
        $this->request->setAccuracy('5ft');
        $this->request->setMaxResults(200);
        $this->request->setContainedWithin('247f43d441defc03');
        $this->request->setAttribute_StreetAddress('79 Folsom St');
        $this->request->setCallback('myCallback');
        $oauthRequest = $this->request->createOAuthRequest();
        $expected = array(
            'query'                      => 'Twitter%20HQ',
            'granularity'                => 'city',
            'accuracy'                   => '5ft',
            'max_results'                => '200',
            'contained_within'           => '247f43d441defc03',
            'attribute%3Astreet_address' => '79%20Folsom%20St',
            'callback'                   => 'myCallback'
        );

        $this->assertSame('/geo/search.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getGetParameters());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide both latitude and longitude parameters.
     */
    public function testOAuthRequestWithLatitudeOnly()
    {
        $this->request->setLat('42.42');
        $this->request->createOAuthRequest();
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide both latitude and longitude parameters.
     */
    public function testOAuthRequestWithLongitudeOnly()
    {
        $this->request->setLong('42.42');
        $this->request->createOAuthRequest();
    }
    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a latitude and longitude pair, query and/or ip.
     */
    public function testOAuthRequestWithoutParameters()
    {
        $this->request->createOAuthRequest();
    }
}
