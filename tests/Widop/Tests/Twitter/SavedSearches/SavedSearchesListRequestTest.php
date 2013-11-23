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

use Widop\Twitter\SavedSearches\SavedSearchesListRequest;

/**
 * Saved searches list request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class SavedSearchesListRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\SavedSearches\SavedSearchesListRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new SavedSearchesListRequest('123');
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
    }

    public function testOAuthRequest()
    {
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/saved_searches/list.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertEmpty($oauthRequest->getGetParameters());
    }
}
