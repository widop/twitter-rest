<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Trends;

use Widop\Twitter\Trends\TrendsClosestRequest;

/**
 * Trends closest request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class TrendsClosestRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Trends\TrendsClosestRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new TrendsClosestRequest('122.321', '-122.456');
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

        $this->assertSame('122.321', $this->request->getLat());
        $this->assertSame('-122.456', $this->request->getLong());
    }

    public function testLatitude()
    {
        $this->request->setLat('160.2');

        $this->assertSame('160.2', $this->request->getLat());
    }

    public function testLongitude()
    {
        $this->request->setLong('160.2');

        $this->assertSame('160.2', $this->request->getLong());
    }

    public function testOAuthRequest()
    {
        $expected = array(
            'lat'  => '122.321',
            'long' => '-122.456'
        );
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/trends/closest.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getGetParameters());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must specify a latitude.
     */
    public function testOAuthRequestWithoutLatitude()
    {
        $this->request->setLat(null);
        $this->request->createOAuthRequest();
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must specify a longitude.
     */
    public function testOAuthRequestWithoutLongitude()
    {
        $this->request->setLong(null);
        $this->request->createOAuthRequest();
    }
}
