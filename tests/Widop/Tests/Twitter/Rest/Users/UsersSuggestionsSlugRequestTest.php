<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Rest\Users;

use Widop\Twitter\Rest\Users\UsersSuggestionsSlugRequest;

/**
 * Users suggestions slug request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class UsersSuggestionsSlugRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Users\UsersSuggestionsSlugRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new UsersSuggestionsSlugRequest('twitter');
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

        $this->assertSame('twitter', $this->request->getSlug());
        $this->assertNull($this->request->getLang());
    }

    public function testSlug()
    {
        $this->request->setSlug('foo');

        $this->assertSame('foo', $this->request->getSlug());
    }

    public function testLang()
    {
        $this->request->setLang('fr');

        $this->assertSame('fr', $this->request->getLang());
    }

    public function testOAuthRequest()
    {
        $this->request->setLang('fr');

        $oauthRequest = $this->request->createOAuthRequest();
        $oauthRequest->setBaseUrl('https://api.twitter.com/1.1');

        $this->assertSame(
            'https://api.twitter.com/1.1/users/suggestions/twitter.json',
            $oauthRequest->getSignatureUrl()
        );
        $this->assertSame('/users/suggestions/:slug.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertSame(array('lang' => 'fr'), $oauthRequest->getGetParameters());
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
