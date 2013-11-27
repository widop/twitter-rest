<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Users;

use Widop\Twitter\Users\UsersSuggestionsSlugMembersRequest;

/**
 * Users suggestions slug members request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class UsersSuggestionsSlugMembersRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Users\UsersSuggestionsSlugMembersRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new UsersSuggestionsSlugMembersRequest('twitter');
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

        $this->assertSame('twitter', $this->request->getSlug());
    }

    public function testSlug()
    {
        $this->request->setSlug('foo');

        $this->assertSame('foo', $this->request->getSlug());
    }

    public function testOAuthRequest()
    {
        $oauthRequest = $this->request->createOAuthRequest();
        $oauthRequest->setBaseUrl('https://api.twitter.com/1.1');

        $this->assertSame(
            'https://api.twitter.com/1.1/users/suggestions/twitter/members.json',
            $oauthRequest->getSignatureUrl()
        );
        $this->assertSame('/users/suggestions/:slug/members.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertEmpty($oauthRequest->getGetParameters());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a slug.
     */
    public function testOAuthRequestWithoutSlug()
    {
        $this->request->setSlug(null);
        $this->request->createOAuthRequest();
    }
}
