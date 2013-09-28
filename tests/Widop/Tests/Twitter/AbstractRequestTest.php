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

    public function testInheritance()
    {
        $this->assertInstanceOf('Widop\Twitter\OAuth\OAuthRequest', $this->request);
    }
}
