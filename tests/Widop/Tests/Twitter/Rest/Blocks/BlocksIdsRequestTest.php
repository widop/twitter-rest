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

use Widop\Twitter\Rest\Blocks\BlocksIdsRequest;

/**
 * Blocks ids request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class BlocksIdsRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Blocks\BlocksIdsRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new BlocksIdsRequest();
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

        $this->assertNull($this->request->getStringifyIds());
        $this->assertNull($this->request->getCursor());
    }

    public function testStringifyIds()
    {
        $this->request->setStringifyIds(true);

        $this->assertTrue($this->request->getStringifyIds());
    }

    public function testCursor()
    {
        $this->request->setCursor('123456789');

        $this->assertSame('123456789', $this->request->getCursor());
    }

    public function testOAuthRequest()
    {
        $this->request->setStringifyIds(true);
        $this->request->setCursor('123456789');

        $oauthRequest = $this->request->createOAuthRequest();

        $expected = array(
            'stringify_ids' => '1',
            'cursor'        => '123456789',
        );

        $this->assertSame('/blocks/ids.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertEquals($expected, $oauthRequest->getGetParameters());
    }
}
