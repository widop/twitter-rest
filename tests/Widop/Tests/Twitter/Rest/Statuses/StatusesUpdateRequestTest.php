<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Rest\Statuses;

use Widop\Twitter\Rest\Statuses\StatusesUpdateRequest;

/**
 * Statuses update request test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StatusesUpdateRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Statuses\StatusesUpdateRequest */
    protected $request;

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
        $this->assertInstanceOf('Widop\Twitter\Rest\AbstractRequest', $this->request);

        $this->assertSame('My New Status!', $this->request->getStatus());
        $this->assertNull($this->request->getInReplyToStatusId());
        $this->assertNull($this->request->getLat());
        $this->assertNull($this->request->getLong());
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

    public function testLat()
    {
        $this->request->setLat('37.7821120598956');

        $this->assertSame('37.7821120598956', $this->request->getLat());
    }

    public function testLong()
    {
        $this->request->setLong('-122.400612831116');

        $this->assertSame('-122.400612831116', $this->request->getLong());
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

    public function testOAuthRequest()
    {
        $this->request->setInReplyToStatusId('123');
        $this->request->setLat('37.7821120598956');
        $this->request->setLong('-122.400612831116');
        $this->request->setPlaceId('df51dec6f4ee2b2c');
        $this->request->setDisplayCoordinates(true);
        $this->request->setTrimUser(true);

        $oauthRequest = $this->request->createOAuthRequest();

        $expected = array(
            'status'                => 'My%20New%20Status%21',
            'in_reply_to_status_id' => '123',
            'lat'                   => '37.7821120598956',
            'long'                  => '-122.400612831116',
            'place_id'              => 'df51dec6f4ee2b2c',
            'display_coordinates'   => '1',
            'trim_user'             => '1',
        );

        $this->assertSame('/statuses/update.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertEquals($expected, $oauthRequest->getPostParameters());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a status.
     */
    public function testOAuthRequestWithoutStatus()
    {
        $this->request->setStatus(null);

        $this->request->createOAuthRequest();
    }
}
