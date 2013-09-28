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

use Widop\Twitter\Statuses\StatusesShowRequest;

/**
 * Statuses show request test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StatusesShowRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Statuses\StatusesShowRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new StatusesShowRequest('123');
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
        $this->assertSame('/statuses/show.json', $this->request->getPath());
        $this->assertSame('GET', $this->request->getMethod());

        $this->assertSame('123', $this->request->getId());
        $this->assertNull($this->request->getTrimUser());
        $this->assertNull($this->request->getIncludeMyRetweet());
        $this->assertNull($this->request->getIncludeEntities());
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

    public function testIncludeMyRetweet()
    {
        $this->request->setIncludeMyRetweet(true);

        $this->assertTrue($this->request->getIncludeMyRetweet());
    }

    public function testIncludeEntities()
    {
        $this->request->setIncludeEntities(true);

        $this->assertTrue($this->request->getIncludeEntities());
    }

    public function testGetGetParametersWithMinimalInformations()
    {
        $this->assertSame(array('id' => '123'), $this->request->getGetParameters());
    }

    public function testGetGetParametersWithFullInformations()
    {
        $this->request->setTrimUser(true);
        $this->request->setIncludeMyRetweet(true);
        $this->request->setIncludeEntities(true);

        $expected = array(
            'id'                 => '123', 
            'trim_user'          => '1',
            'include_my_retweet' => '1',
            'include_entities'   => '1',
        );

        $this->assertSame($expected, $this->request->getGetParameters());
    }
}
