<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Search;

use Widop\Twitter\Search\SearchTweetsRequest;

/**
 * Search tweets request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class SearchTweetsRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Search\SearchTweetsRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new SearchTweetsRequest('@noradio');
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

        $this->assertSame('@noradio', $this->request->getQ());
        $this->assertNull($this->request->getGeocode());
        $this->assertNull($this->request->getLang());
        $this->assertNull($this->request->getLocale());
        $this->assertNull($this->request->getResultType());
        $this->assertNull($this->request->getCount());
        $this->assertNull($this->request->getUntil());
        $this->assertNull($this->request->getSinceId());
        $this->assertNull($this->request->getMaxId());
        $this->assertNull($this->request->getIncludeEntities());
        $this->assertNull($this->request->getCallback());
    }

    public function testQ()
    {
        $this->request->setQ('321');

        $this->assertSame('321', $this->request->getQ());
    }

    public function testGeocode()
    {
        $this->request->setSinceId('37.781157,-122.398720,1mi');

        $this->assertSame('37.781157,-122.398720,1mi', $this->request->getSinceId());
    }

    public function testLang()
    {
        $this->request->setSinceId('fr');

        $this->assertSame('fr', $this->request->getSinceId());
    }

    public function testLocale()
    {
        $this->request->setSinceId('ja');

        $this->assertSame('ja', $this->request->getSinceId());
    }

    public function testResultType()
    {
        $this->request->setSinceId('mixed');

        $this->assertSame('mixed', $this->request->getSinceId());
    }

    public function testCount()
    {
        $this->request->setCount(20);

        $this->assertSame(20, $this->request->getCount());
    }

    public function testUntil()
    {
        $now = new \DateTime();

        $this->request->setUntil($now);

        $this->assertSame($now, $this->request->getUntil());
    }

    public function testSinceId()
    {
        $this->request->setSinceId('0123456789');

        $this->assertSame('0123456789', $this->request->getSinceId());
    }


    public function testMaxId()
    {
        $this->request->setMaxId('0123456789');

        $this->assertSame('0123456789', $this->request->getMaxId());
    }

    public function testIncludeEntities()
    {
        $this->request->setIncludeEntities(true);

        $this->assertTrue($this->request->getIncludeEntities());
    }

    public function testCallback()
    {
        $this->request->setMaxId('processTweets');

        $this->assertSame('processTweets', $this->request->getMaxId());
    }

    public function testOAuthRequest()
    {
        $this->request->setGeocode('37.781157,-122.398720,1mi');
        $this->request->setLang('fr');
        $this->request->setLocale('ja');
        $this->request->setResultType('mixed');
        $this->request->setCount(200);
        $this->request->setUntil('2013-11-09');
        $this->request->setSinceId('123456789');
        $this->request->setMaxId('123456789');
        $this->request->setIncludeEntities(true);
        $this->request->setCallback('processTweets');

        $oauthRequest = $this->request->createOAuthRequest();

        $expected = array(
            'q'                => '%40noradio',
            'geocode'          => '37.781157%2C-122.398720%2C1mi',
            'lang'             => 'fr',
            'locale'           => 'ja',
            'result_type'      => 'mixed',
            'count'            => '200',
            'until'            => '2013-11-09',
            'since_id'         => '123456789',
            'max_id'           => '123456789',
            'include_entities' => '1',
            'callback'         => 'processTweets',
        );

        $this->assertSame('/search/tweets.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getGetParameters());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a query.
     */
    public function testOAuthRequestWithoutQuery()
    {
        $this->request->setQ(null);

        $this->request->createOAuthRequest();
    }
}
