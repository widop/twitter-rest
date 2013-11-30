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

use Widop\Twitter\Rest\AbstractRequest;
use Widop\Twitter\Rest\Options\OptionBag;

/**
 * Followers list request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/followers/list
 *
 * @method string|null  getUserId()                                          Gets the user ID.
 * @method null         setUserId(string $userId)                            Sets the user ID.
 * @method string|null  getScreenName()                                      Gets the user screen name.
 * @method null         setScreenName(string $screenName)                    Sets the user screen name.
 * @method string|null  getCursor()                                          Gets the cursor.
 * @method null         setCursor(string $cursor)                            Sets the cursor.
 * @method integer|null getCount()                                           Gets the number of users.
 * @method null         setCount(integer $count)                             Sets the number of users (max: 200).
 * @method boolean|null getSkipStatus()                                      Gets if the user status will be returned.
 * @method null         setSkipStatus(boolean $skipStatus)                   Sets if the user status will be returned.
 * @method boolean|null getIncludeUserEntities()                             Gets if user entities node will be returned.
 * @method null         setIncludeUserEntities(boolean $includeUserEntities) Sets if user entities node will be returned.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class FollowersListRequest extends AbstractRequest
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
            ->register('count')
            ->register('skip_status')
            ->register('include_user_entities');
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
        return '/followers/list.json';
    }
}
