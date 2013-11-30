<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Rest\Options;

use Widop\Twitter\Rest\Options\OptionBag;

/**
 * Option bag test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OptionBagTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Options\OptionBag */
    private $optionBag;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->optionBag = new OptionBag();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->optionBag);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The option should be either a string or a "Widop\Twitter\Rest\Options\OptionInterface".
     */
    public function testRegisterWithInvalidValue()
    {
        $this->optionBag->register(array());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The option "foo" does not exist.
     */
    public function testArrayAccessWithInvalidValue()
    {
        $this->optionBag['foo'];
    }
}
