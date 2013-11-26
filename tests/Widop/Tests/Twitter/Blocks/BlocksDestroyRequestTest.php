<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Blocks;

use Widop\Twitter\Blocks\BlocksDestroyRequest;

/**
 * Blocks destroy request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class BlocksDestroyRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Blocks\BlocksDestroyRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new BlocksDestroyRequest();
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

        $this->assertNull($this->request->getUserId());
        $this->assertNull($this->request->getScreenName());
        $this->assertNull($this->request->getIncludeEntities());
        $this->assertNull($this->request->getSkipStatus());
    }

    public function testUserId()
    {
        $this->request->setUserId('0123456789');

        $this->assertSame('0123456789', $this->request->getUserId());
    }

    public function testScreenName()
    {
        $this->request->setScreenName('noradio');

        $this->assertSame('noradio', $this->request->getScreenName());
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

    public function testOAuthRequestWithScreenName()
    {
        $this->request->setScreenName('noradio');
        $this->request->setIncludeEntities(true);
        $this->request->setSkipStatus(true);

        $oauthRequest = $this->request->createOAuthRequest();

        $expected = array(
            'screen_name'      => 'noradio',
            'include_entities' => '1',
            'skip_status'      => '1',
        );

        $this->assertSame('/blocks/destroy.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertEquals($expected, $oauthRequest->getPostParameters());
    }

    public function testOAuthRequestWithUserId()
    {
        $this->request->setUserId('123456789');
        $this->request->setIncludeEntities(true);
        $this->request->setSkipStatus(true);

        $oauthRequest = $this->request->createOAuthRequest();

        $expected = array(
            'user_id'          => '123456789',
            'include_entities' => '1',
            'skip_status'      => '1',
        );

        $this->assertSame('/blocks/destroy.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertEquals($expected, $oauthRequest->getPostParameters());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a user id or a screen name.
     */
    public function testOAuthRequestWithoutUserId()
    {
        $this->request->createOAuthRequest();
    }
}
