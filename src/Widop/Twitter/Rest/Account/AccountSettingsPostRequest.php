<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Account;

use Widop\Twitter\Options\OptionBag;
use Widop\Twitter\Options\OptionInterface;
use Widop\Twitter\Rest\AbstractPostRequest;

/**
 * Account settings POST request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/account/settings
 *
 * @method string|null  getTrendLocationWoeid()                   Gets the WOEID to use as the default trend location.
 * @method null         setTrendLocationWoeid(string $woeid)      Sets the WOEID to use as the default trend location.
 * @method boolean|null getSleepTimeEnabled()                     Checks if sleep time is enabled.
 * @method null         setSleepTimeEnabled(boolean $enabled)     Sets if sleep time is enabled.
 * @method string|null  getStartSleepTime()                       Gets the hour the sleep time begins.
 * @method null         setStartSleepTime(string $startSleepTime) Sets the hour the sleep time begins (00-23).
 * @method string|null  getEndSleepTime()                         Gets the hour the sleep time ends.
 * @method null         setEndSleepTime(string $endSleepTime)     Sets the hour the sleep time ends (00-23).
 * @method boolean|null getTimeZone()                             Gets the timezone dates/times to be displayed in.
 * @method null         setTimeZone(boolean $timeZone)            Sets the timezone dates/times to be displayed in.
 * @method string|null  getLang()                                 Gets the language which Twitter should render in.
 * @method null         setLang(string $lang)                     Sets the language which Twitter should render in.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class AccountSettingsPostRequest extends AbstractPostRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('trend_location_woeid', OptionInterface::TYPE_POST)
            ->register('sleep_time_enabled', OptionInterface::TYPE_POST)
            ->register('start_sleep_time', OptionInterface::TYPE_POST)
            ->register('end_sleep_time', OptionInterface::TYPE_POST)
            ->register('time_zone', OptionInterface::TYPE_POST)
            ->register('lang', OptionInterface::TYPE_POST);
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        foreach ($optionBag as $option) {
            if (isset($optionBag[$option->getName()])) {
                return;
            }
        }

        throw new \RuntimeException('You must provide at least one parameter to update your account.');
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/account/settings.json';
    }
}
