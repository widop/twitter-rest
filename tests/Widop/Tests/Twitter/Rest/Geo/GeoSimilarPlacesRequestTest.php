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

use Widop\Twitter\Rest\Geo\GeoSimilarPlacesRequest;

/**
 * Geo similar places request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class GeoSimilarPlacesRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Geo\GeoSimilarPlacesRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new GeoSimilarPlacesRequest('10.10', '-12.45', 'Twitter HQ');
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
        $this->assertSame('Twitter HQ', $this->request->getName());
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

    public function testName()
    {
        $this->request->setName('Twitter HQ');

        $this->assertSame('Twitter HQ', $this->request->getName());
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
        $this->request->setContainedWithin('247f43d441defc03');
        $this->request->setAttribute_StreetAddress('79 Folsom St');
        $this->request->setCallback('myCallback');
        $oauthRequest = $this->request->createOAuthRequest();
        $expected = array(
            'lat'                        => '10.10',
            'long'                       => '-12.45',
            'name'                       => 'Twitter%20HQ',
            'contained_within'           => '247f43d441defc03',
            'attribute%3Astreet_address' => '79%20Folsom%20St',
            'callback'                   => 'myCallback'
        );

        $this->assertSame('/geo/similar_places.json', $oauthRequest->getPath());
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

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a name.
     */
    public function testOAuthRequestWithoutName()
    {
        $this->request->setName(null);
        $this->request->createOAuthRequest();
    }
}
