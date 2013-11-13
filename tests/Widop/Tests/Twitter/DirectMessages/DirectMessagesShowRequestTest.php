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

use Widop\Twitter\DirectMessages\DirectMessagesShowRequest;

/**
 * Statuses show request test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectMessagesShowRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\DirectMessages\DirectMessagesShowRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new DirectMessagesShowRequest('123');
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
        $this->assertSame('/direct_messages/show.json', $this->request->getPath());
        $this->assertSame('GET', $this->request->getMethod());
        $this->assertSame('123', $this->request->getId());
    }

    public function testId()
    {
        $this->request->setId('321');

        $this->assertSame('321', $this->request->getId());
    }
    public function testGetGetParametersWithoutParameters()
    {
        $this->assertSame(array('id' => '123'), $this->request->getGetParameters());
    }

    public function testGetGetParametersWithParameters()
    {
        $this->request->setId('12344');

        $this->assertSame(array('id' => '12344'), $this->request->getGetParameters());
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testGetGetParametersWithoutId()
    {
        $this->request->setId(null);
        $this->request->getGetParameters();
    }
}
