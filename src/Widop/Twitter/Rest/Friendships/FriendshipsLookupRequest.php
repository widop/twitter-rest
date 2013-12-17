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

use Widop\Twitter\Options\OptionBag;
use Widop\Twitter\Rest\AbstractGetRequest;

/**
 * Friendships lookup request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/friendships/lookup
 *
 * @method string|null getUserId()                       Gets the comma separated list of user IDs.
 * @method null        setUserId(string $userId)         Sets the comma separated list of user IDs (max: 100).
 * @method string|null getScreenName()                   Gets the comma separated list of screen names.
 * @method null        setScreenName(string $screenName) Sets the comma separated list of screen names (max: 100).
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class FriendshipsLookupRequest extends AbstractGetRequest
{
/**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('user_id')
            ->register('screen_name');
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
        return '/friendships/lookup.json';
    }
}
