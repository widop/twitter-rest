<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Rest\Lists;

use Widop\Twitter\Rest\Lists\ListsCreateRequest;

/**
 * Lists create request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class ListsCreateRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Lists\ListsCreateRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new ListsCreateRequest('sandwiches');
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
        $this->assertSame('sandwiches', $this->request->getName());
        $this->assertNull($this->request->getMode());
        $this->assertNull($this->request->getDescription());
    }

    public function testName()
    {
        $this->request->setName('kebab');

        $this->assertSame('kebab', $this->request->getName());
    }

    public function testMode()
    {
        $this->request->setMode('public');

        $this->assertSame('public', $this->request->getMode());
    }

    public function testDescription()
    {
        $this->request->setDescription('kebab');

        $this->assertSame('kebab', $this->request->getDescription());
    }

    public function testOAuthRequestWithParameters()
    {
        $this->request->setMode('public');
        $this->request->setDescription('For the sandwiches lovers');
        $expected = array(
            'name'        => 'sandwiches',
            'mode'        => 'public',
            'description' => 'For%20the%20sandwiches%20lovers'
        );
        $oauthRequest = $this->request->createOAuthRequest();
        $this->assertSame('/lists/create.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getPostParameters());
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
