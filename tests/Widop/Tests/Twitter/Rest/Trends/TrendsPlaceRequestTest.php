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

use Widop\Twitter\Rest\Trends\TrendsPlaceRequest;

/**
 * Trends place request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class TrendsPlaceRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Trends\TrendsPlaceRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new TrendsPlaceRequest('123');
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

        $this->assertSame('123', $this->request->getId());
        $this->assertNull($this->request->getExclude());
    }

    public function testId()
    {
        $this->request->setId('0123456789');

        $this->assertSame('0123456789', $this->request->getId());
    }

    public function testExclude()
    {
        $this->request->setExclude(true);

        $this->assertTrue($this->request->getExclude());
    }

    public function testOAuthRequestWithoutParameters()
    {
        $oauthRequest = $this->request->createOAuthRequest();
        $this->assertSame(array('id' => '123'), $oauthRequest->getGetParameters());
    }

    public function testOAuthRequestWithParameters()
    {
        $this->request->setExclude(true);

        $expected = array(
            'id'      => '123',
            'exclude' => '1'
        );
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame($expected, $oauthRequest->getGetParameters());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a WOEID.
     */
    public function testOAuthRequestWithoutId()
    {
        $this->request->setId(null);
        $this->request->createOAuthRequest();
    }
}
