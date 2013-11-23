<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\SavedSearches;

use Widop\Twitter\SavedSearches\SavedSearchesCreateRequest;

/**
 * Saved searches create request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class SavedSearchesCreateRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\SavedSearches\SavedSearchesCreateRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new SavedSearchesCreateRequest('sandwiches');
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
        $this->assertSame('sandwiches', $this->request->getQuery());
    }

    public function testQuery()
    {
        $this->request->setQuery('kebab');

        $this->assertSame('kebab', $this->request->getQuery());
    }

    public function testOAuthRequestWithParameters()
    {
        $oauthRequest = $this->request->createOAuthRequest();
        $this->assertSame('/saved_searches/create.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertSame(array('query' => 'sandwiches'), $oauthRequest->getPostParameters());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must specify a query.
     */
    public function testOAuthRequestWithoutQuery()
    {
        $this->request->setQuery(null);
        $this->request->createOAuthRequest();
    }
}
