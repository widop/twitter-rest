<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Friendships;

use Widop\Twitter\Rest\AbstractRequest;
use Widop\Twitter\Rest\Options\OptionBag;
use Widop\Twitter\Rest\Options\OptionInterface;

/**
 * Friendships update request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/friendships/update
 *
 * @method string|null   getUserId()                       Gets the user ID.
 * @method null          setUserId(string $userId)         Sets the user ID.
 * @method string|null   getScreenName()                   Gets the user screen name.
 * @method null          setScreenName(string $screenName) Sets the user screen name.
 * @method boolean|null  getDevice()                       Gets if device notifications will be enabled.
 * @method null          setDevice(boolean $device)        Sets if device notifications will be enabled.
 * @method boolean|null  getRetweets()                     Gets if retweets will be enabled.
 * @method null          setRetweets(boolean $retweets)    Sets if retweets will be enabled.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class FriendshipsUpdateRequest extends AbstractRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('user_id', OptionInterface::TYPE_POST)
            ->register('screen_name', OptionInterface::TYPE_POST)
            ->register('device_notification', OptionInterface::TYPE_POST)
            ->register('retweets', OptionInterface::TYPE_POST);
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
        return '/friendships/update.json';
    }

    /**
     * {@inheritdoc}
     */
    protected function getMethod()
    {
        return 'POST';
    }
}
