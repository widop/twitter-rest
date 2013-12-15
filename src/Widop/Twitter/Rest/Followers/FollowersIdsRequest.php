<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Followers;

use Widop\Twitter\Rest\AbstractGetRequest;
use Widop\Twitter\Rest\Options\OptionBag;

/**
 * Followers ids request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/followers/ids
 *
 * @method string|null  getUserId()                            Gets the user ID.
 * @method null         setUserId(string $userId)              Sets the user ID.
 * @method string|null  getScreenName()                        Gets the user screen name.
 * @method null         setScreenName(string $screenName)      Sets the user screen name.
 * @method string|null  getCursor()                            Gets the cursor.
 * @method null         setCursor(string $cursor)              Sets the cursor.
 * @method boolean|null getStringifyIds()                      Gets if the tweets ids will be returned as strings.
 * @method null         setStringifyIds(boolean $stringifyIds) Sets if the tweets ids will be returned as strings.
 * @method integer|null getCount()                             Gets the number of ids.
 * @method null         setCount(integer $count)               Sets the number of ids (max: 5000).
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class FollowersIdsRequest extends AbstractGetRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('user_id')
            ->register('screen_name')
            ->register('cursor')
            ->register('stringify_ids')
            ->register('count');
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
        return '/followers/ids.json';
    }
}
