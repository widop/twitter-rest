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

use Widop\Twitter\SavedSearches\SavedSearchesDestroyRequest;

/**
 * Saved searches destroy request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class SavedSearchesDestroyRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\SavedSearches\SavedSearchesDestroyRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new SavedSearchesDestroyRequest('123');
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
        $this->assertSame('123', $this->request->getId());
    }

    public function testId()
    {
        $this->request->setId('0123456789');

        $this->assertSame('0123456789', $this->request->getId());
    }

    public function testOAuthRequestWithParameters()
    {
        $this->request->setId('123456789');
        $oauthRequest = $this->request->createOAuthRequest();
        $oauthRequest->setBaseUrl('https://api.twitter.com/1.1');

        $this->assertSame(
            'https://api.twitter.com/1.1/saved_searches/destroy/123456789.json',
            $oauthRequest->getSignatureUrl()
        );
        $this->assertSame('/saved_searches/destroy/:id.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertEmpty($oauthRequest->getPostParameters());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must specify an id.
     */
    public function testOAuthRequestWithoutId()
    {
        $this->request->setId(null);
        $this->request->createOAuthRequest();
    }
}
