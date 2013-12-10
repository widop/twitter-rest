<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Rest\Blocks;

use Widop\Twitter\Rest\Blocks\BlocksListRequest;

/**
 * Blocks list request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class BlocksListRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Blocks\BlocksListRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new BlocksListRequest();
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

        $this->assertNull($this->request->getIncludeEntities());
        $this->assertNull($this->request->getSkipStatus());
        $this->assertNull($this->request->getCursor());
    }

    public function testIncludeEntities()
    {
        $this->request->setIncludeEntities(true);

        $this->assertTrue($this->request->getIncludeEntities());
    }

    public function testSkipStatus()
    {
        $this->request->setSkipStatus(true);

        $this->assertTrue($this->request->getSkipStatus());
    }

    public function testCursor()
    {
        $this->request->setCursor('123456789');

        $this->assertSame('123456789', $this->request->getCursor());
    }

    public function testOAuthRequest()
    {
        $this->request->setIncludeEntities(true);
        $this->request->setSkipStatus(true);
        $this->request->setCursor('123456789');

        $oauthRequest = $this->request->createOAuthRequest();

        $expected = array(
            'include_entities' => 'true',
            'skip_status'      => 'true',
            'cursor'           => '123456789',
        );

        $this->assertSame('/blocks/list.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertEquals($expected, $oauthRequest->getGetParameters());
    }
}
