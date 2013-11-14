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

use Widop\Twitter\Favorites\FavoritesListRequest;

/**
 * Favorites list request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class FavoritesListRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Favorites\FavoritesListRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new FavoritesListRequest();
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
        $this->assertSame('/favorites/list.json', $this->request->getPath());
        $this->assertSame('GET', $this->request->getMethod());

        $this->assertNull($this->request->getUserId());
        $this->assertNull($this->request->getScreenName());
        $this->assertNull($this->request->getCount());
        $this->assertNull($this->request->getSinceId());
        $this->assertNull($this->request->getMaxId());
        $this->assertNull($this->request->getIncludeEntities());
    }

    public function testUserId()
    {
        $this->request->setUserId('0123456789');

        $this->assertSame('0123456789', $this->request->getUserId());
    }

    public function testScreenName()
    {
        $this->request->setScreenName('0123456789');

        $this->assertSame('0123456789', $this->request->getScreenName());
    }

    public function testSinceId()
    {
        $this->request->setSinceId('0123456789');

        $this->assertSame('0123456789', $this->request->getSinceId());
    }

    public function testCount()
    {
        $this->request->setCount(20);

        $this->assertSame(20, $this->request->getCount());
    }

    public function testMaxId()
    {
        $this->request->setMaxId('0123456789');

        $this->assertSame('0123456789', $this->request->getMaxId());
    }

    public function testIncludeEntities()
    {
        $this->request->setIncludeEntities(true);

        $this->assertTrue($this->request->getIncludeEntities());
    }

    public function testGetGetParametersWithoutParameters()
    {
        $this->assertEmpty($this->request->getGetParameters());
    }

    public function testGetGetParametersWithParameters()
    {
        $this->request->setScreenName('foo');
        $this->request->setSinceId('0123456789');
        $this->request->setCount(50);
        $this->request->setMaxId('9876543210');
        $this->request->setIncludeEntities(true);

        $expected = array(
            'screen_name'      => 'foo',
            'count'            => '50',
            'since_id'         => '0123456789',
            'max_id'           => '9876543210',
            'include_entities' => '1',
        );

        $this->assertSame($expected, $this->request->getGetParameters());
    }

    public function testGetGetParametersWithUserId()
    {
        $this->request->setUserId('0123456789');

        $this->assertSame(array('user_id' => '0123456789'), $this->request->getGetParameters());
    }

    public function testGetGetParametersWithUserIdAndScreenName()
    {
        $this->request->setUserId('0123456789');
        $this->request->setScreenName('foo');

        $this->assertSame(array('user_id' => '0123456789'), $this->request->getGetParameters());
    }
}
