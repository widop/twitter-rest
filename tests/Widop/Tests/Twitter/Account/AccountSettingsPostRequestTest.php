<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Account;

use Widop\Twitter\Account\AccountSettingsPostRequest;

/**
 * Account settings POSt request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class AccountSettingsPostRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Account\AccountSettingsPostRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new AccountSettingsPostRequest();
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

        $this->assertNull($this->request->getTrendLocationWoeid());
        $this->assertNull($this->request->getSleepTimeEnabled());
        $this->assertNull($this->request->getStartSleepTime());
        $this->assertNull($this->request->getEndSleepTime());
        $this->assertNull($this->request->getTimeZone());
        $this->assertNull($this->request->getLang());
    }

    public function testTrendLocationWoeid()
    {
        $this->request->setTrendLocationWoeid('123');

        $this->assertSame('123', $this->request->getTrendLocationWoeid());
    }

    public function testSleepTimeEnabled()
    {
        $this->request->setSleepTimeEnabled(true);

        $this->assertTrue($this->request->getSleepTimeEnabled());
    }

    public function testStartSleepTime()
    {
        $this->request->setStartSleepTime('00');

        $this->assertSame('00', $this->request->getStartSleepTime());
    }

    public function testEndSleepTime()
    {
        $this->request->setEndSleepTime('23');

        $this->assertSame('23', $this->request->getEndSleepTime());
    }

    public function testTimeZone()
    {
        $this->request->setTimeZone('Europe/Paris');

        $this->assertSame('Europe/Paris', $this->request->getTimeZone());
    }

    public function testLang()
    {
        $this->request->setLang('fr');

        $this->assertSame('fr', $this->request->getLang());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide at least one parameter to update your account.
     */
    public function testOAuthRequestWithoutParameters()
    {
        $this->request->createOAuthRequest();
    }

    public function testOAuthRequest()
    {
        $expected = array(
            'trend_location_woeid' => '123456',
            'sleep_time_enabled'   => '1',
            'start_sleep_time'     => '00',
            'end_sleep_time'       => '23',
            'time_zone'            => 'Europe%2FParis',
            'lang'                 => 'fr'
        );
        $this->request->setTrendLocationWoeid('123456');
        $this->request->setSleepTimeEnabled(true);
        $this->request->setStartSleepTime('00');
        $this->request->setEndSleepTime('23');
        $this->request->setTimeZone('Europe/Paris');
        $this->request->setLang('fr');
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/account/settings.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getPostParameters());
    }
}
