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

/**
 * Abstract boolean option test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class AbstractDateTimeOptionTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Options\AbstractDateTimeOption */
    private $dateTimeOption;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->dateTimeOption = $this->getMockForAbstractClass('Widop\Twitter\Rest\Options\AbstractDateTimeOption');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->dateTimeOption);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetValueWithInvalidValue()
    {
        $this->dateTimeOption->setValue('bar');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetValueWithInvalidType()
    {
        $this->dateTimeOption->setValue(new \stdClass());
    }

    public function testNormalizedValue()
    {
        $this->dateTimeOption->setValue(new \DateTime('2013-12-10'));
        $this->assertSame('2013-12-10', $this->dateTimeOption->getNormalizedValue());
    }
}
