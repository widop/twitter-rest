<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter;

use Widop\Twitter\Statuses\StatusesShowRequest;

/**
 * Abstract request test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AbstractRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\AbstractRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = $this->getMockForAbstractClass('Widop\Twitter\AbstractRequest');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->request);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage The method "foo" does not exist.
     */
    public function testInvalidMethodPrefix()
    {
        $this->request->foo();
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage You must specify an argument to the method "setId".
     */
    public function testInvalidOption()
    {
        $this->request = new StatusesShowRequest('123');
        $this->request->setId();
    }
}
