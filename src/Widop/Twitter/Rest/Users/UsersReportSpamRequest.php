<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Users;

use Widop\Twitter\Options\OptionBag;
use Widop\Twitter\Options\OptionInterface;
use Widop\Twitter\Rest\AbstractPostRequest;

/**
 * Users spam report request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/users/report_spam
 *
 * @method string|null getUserId()                       Gets the user ID who will be reported.
 * @method null        setUserId(string $userId)         Sets the user ID who will be reported.
 * @method string|null getScreenName()                   Gets the user screen name who will be reported.
 * @method null        setScreenName(string $screenName) Sets the user screen name who will be reported.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class UsersReportSpamRequest extends AbstractPostRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('user_id', OptionInterface::TYPE_POST)
            ->register('screen_name', OptionInterface::TYPE_POST);
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        if (!isset($optionBag['user_id']) && !isset($optionBag['screen_name'])) {
            throw new \RuntimeException('You must provide a user id or a screen name.');
        }

        if (isset($optionBag['user_id'])) {
            unset($optionBag['screen_name']);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/users/spam_report.json';
    }
}
