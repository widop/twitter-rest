<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\DirectMessages;

use Widop\Twitter\DirectMessages\DirectMessagesDestroyRequest;

/**
 * Direct messages destroy request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class DirectMessagesDestroyRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\DirectMessages\DirectMessagesDestroyRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new DirectMessagesDestroyRequest('123');
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
        $this->assertNull($this->request->getIncludeEntities());
    }

    public function testId()
    {
        $this->request->setId('0123456789');

        $this->assertSame('0123456789', $this->request->getId());
    }

    public function testIncludeEntities()
    {
        $this->request->setIncludeEntities(true);

        $this->assertTrue($this->request->getIncludeEntities());
    }

    public function testOAuthRequest()
    {
        $this->request->setId('123456789');
        $this->request->setIncludeEntities(true);

        $oauthRequest = $this->request->createOAuthRequest();

        $expected = array(
            'id'               => '123456789',
            'include_entities' => '1'
        );

        $this->assertSame('/direct_messages/destroy.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertEquals($expected, $oauthRequest->getPostParameters());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide an id.
     */
    public function testOAuthRequestWithoutId()
    {
        $this->request->setId(null);

        $this->request->createOAuthRequest();
    }
}
