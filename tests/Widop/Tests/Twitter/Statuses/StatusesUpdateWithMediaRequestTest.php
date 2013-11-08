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

use Widop\Twitter\Statuses\StatusesUpdateWithMediaRequest;

/**
 * Statuses update with media request test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StatusesUpdateWithMediaRequestTest extends StatusesUpdateRequestTest
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new StatusesUpdateWithMediaRequest('My New Status!', __FILE__);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf('Widop\Twitter\AbstractRequest', $this->request);
        $this->assertSame('/statuses/update_with_media.json', $this->request->getPath());
        $this->assertSame('POST', $this->request->getMethod());

        $this->assertSame('My New Status!', $this->request->getStatus());
        $this->assertNull($this->request->getInReplyToStatusId());
        $this->assertNull($this->request->getLatitude());
        $this->assertNull($this->request->getLongitude());
        $this->assertNull($this->request->getPlaceId());
        $this->assertNull($this->request->getDisplayCoordinates());
        $this->assertNull($this->request->getTrimUser());
        $this->assertSame(__FILE__, $this->request->getMedia());
    }

    public function testMediaWithValidValue()
    {
        $media = __DIR__.'/StatusesUpdateRequestTest.php';
        $this->request->setMedia($media);

        $this->assertSame($media, $this->request->getMedia());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The media "/foo" does not exist.
     */
    public function testMediaWithInvalidValue()
    {
        $this->request->setMedia('/foo');
    }

    public function testHasFileParameters()
    {
        return $this->assertTrue($this->request->hasFileParameters());
    }

    public function testFileParameters()
    {
        $this->assertSame(array('media[]' => __FILE__), $this->request->getFileParameters());
    }
}
