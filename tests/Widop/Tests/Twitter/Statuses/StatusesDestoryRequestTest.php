<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Statuses;

use Widop\Twitter\Statuses\StatusesDestroyRequest;

/**
 * Statuses destory request test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StatusesDestoryRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Statuses\StatusesDestroyRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new StatusesDestroyRequest('123');
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
        $this->assertSame('/statuses/destroy/:id.json', $this->request->getPath());
        $this->assertSame('POST', $this->request->getMethod());

        $this->assertSame('123', $this->request->getId());
        $this->assertNull($this->request->getTrimUser());
    }

    public function testId()
    {
        $this->request->setId('321');

        $this->assertSame('321', $this->request->getId());
    }

    public function testTrimUser()
    {
        $this->request->setTrimUser(true);

        $this->assertTrue($this->request->getTrimUser());
    }

    public function testSignatureUrl()
    {
        $this->request->setBaseUrl('https://api.twitter.com/oauth');

        $this->assertSame(
            'https://api.twitter.com/oauth/statuses/destroy/123.json',
            $this->request->getSignatureUrl()
        );
    }

    public function testGetPostParametersWithoutParameters()
    {
        $this->assertEmpty($this->request->getPostParameters());
    }

    public function testGetPostParametersWithParameters()
    {
        $this->request->setTrimUser(true);

        $this->assertSame(array('trim_user' => '1'), $this->request->getPostParameters());
    }
}
