<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\OAuth\Signature;

/**
 * Abstract OAuth rsa sha1 signature.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AbstractOAuthRsaSha1Signature extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\OAuth\Signature\OAuthPlaintextSignature */
    private $signature;

    /** @var \Widop\Twitter\OAuth\OAuthRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = $this->getMock('Widop\Twitter\OAuth\OAuthRequest');
        $this->request
            ->expects($this->any())
            ->method('getSignature')
            ->will($this->returnValue('signature'));

        $this->signature = $this->getMockForAbstractClass('Widop\Twitter\OAuth\Signature\AbstractOAuthRsaSha1Signature');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->request);
        unset($this->signature);
    }

    public function testName()
    {
        $this->assertSame('RSA-SHA1', $this->signature->getName());
    }

    public function testGenarate()
    {
        $this->signature
            ->expects($this->once())
            ->method('getPrivateCertificate')
            ->will($this->returnValue(file_get_contents(__DIR__.'/Fixtures/rsa-sha1')));

        $this->assertSame(
            'jch4ay7HHuIWYjMqjE2RU0+9yEkDQYXokfzdcgtfKFYC6sELOvuUQDOc5WhnnDEUUNy27YECjdNu32UwE1pLlJwe8VeUnsrQsii6wmApy5isURZGpRb2H788amk+L0at3w1XuasHK7Cs3pPxukL46PgV7tv0/SYZ5v+2gcuxykQ=',
            $this->signature->generate($this->request, 'consumer_secret')
        );
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage The certificate private key can not be fetched.
     */
    public function testGenerateWithInvalidPrivateCertificate()
    {
        $this->signature
            ->expects($this->once())
            ->method('getPrivateCertificate')
            ->will($this->returnValue('foo'));

        $this->signature->generate($this->request, 'consumer_secret');
    }
}
