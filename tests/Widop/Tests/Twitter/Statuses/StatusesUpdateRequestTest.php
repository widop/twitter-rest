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

use Widop\Twitter\Statuses\StatusesUpdateRequest;

/**
 * Statuses update request test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StatusesUpdateRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Statuses\StatusesUpdateRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new StatusesUpdateRequest('My New Status!');
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
        $this->assertSame('/statuses/update.json', $this->request->getPath());
        $this->assertSame('POST', $this->request->getMethod());

        $this->assertSame('My New Status!', $this->request->getStatus());
        $this->assertNull($this->request->getInReplyToStatusId());
        $this->assertNull($this->request->getLatitude());
        $this->assertNull($this->request->getLongitude());
        $this->assertNull($this->request->getPlaceId());
        $this->assertNull($this->request->getDisplayCoordinates());
        $this->assertNull($this->request->getTrimUser());
    }

    public function testStatus()
    {
        $this->request->setStatus('foo');

        $this->assertSame('foo', $this->request->getStatus());
    }

    public function testInReplyToStatusId()
    {
        $this->request->setInReplyToStatusId('123');

        $this->assertSame('123', $this->request->getInReplyToStatusId());
    }

    public function testLatitude()
    {
        $this->request->setLatitude('37.7821120598956');

        $this->assertSame('37.7821120598956', $this->request->getLatitude());
    }

    public function testLongitude()
    {
        $this->request->setLongitude('-122.400612831116');

        $this->assertSame('-122.400612831116', $this->request->getLongitude());
    }

    public function testPlaceId()
    {
        $this->request->setPlaceId('df51dec6f4ee2b2c');

        $this->assertSame('df51dec6f4ee2b2c', $this->request->getPlaceId());
    }

    public function testDisplayCoordinates()
    {
        $this->request->setDisplayCoordinates(true);

        $this->assertTrue($this->request->getDisplayCoordinates());
    }

    public function testTrimUser()
    {
        $this->request->setTrimUser(true);

        $this->assertTrue($this->request->getTrimUser());
    }

    public function testGetPostParametersWithMinimalInformations()
    {
        $this->assertSame(array('status' => 'My%20New%20Status%21'), $this->request->getPostParameters());
    }

    public function testGetPostParametersWithFullInformations()
    {
        $this->request->setInReplyToStatusId('123');
        $this->request->setLatitude('37.7821120598956');
        $this->request->setLongitude('-122.400612831116');
        $this->request->setPlaceId('df51dec6f4ee2b2c');
        $this->request->setDisplayCoordinates(true);
        $this->request->setTrimUser(true);

        $expected = array(
            'status'                => 'My%20New%20Status%21',
            'in_reply_to_status_id' => '123',
            'lat'                   => '37.7821120598956',
            'long'                  => '-122.400612831116',
            'place_id'              => 'df51dec6f4ee2b2c',
            'display_coordinates'   => '1',
            'trim_user'             => '1',
        );

        $this->assertSame($expected, $this->request->getPostParameters());
    }
}
