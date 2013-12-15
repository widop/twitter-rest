<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Lists;

use Widop\Twitter\Rest\AbstractRequest;
use Widop\Twitter\Rest\Options\OptionBag;

/**
 * Lists memberships request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/lists/memberships
 *
 * @method string|null  getUserId()                          Gets the user ID.
 * @method null         setUserId(string $userId)            Sets the user ID.
 * @method string|null  getScreenName()                      Gets the user screen name.
 * @method null         setScreenName(string $screenName)    Sets the user screen name.
 * @method string|null  getCursor()                          Gets the cursor.
 * @method null         setCursor(string $cursor)            Sets the cursor.
 * @method boolean|null getFilterToOwnedList()               Checks if the request will only returns lists the given
 *                                                           user owns.
 * @method null         setFilterToOwnedList(boolean $value) Sets if the request will only returns lists the given
 *                                                           user owns.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class ListsMembershipsRequest extends AbstractRequest
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
            ->register('filter_to_owned_lists');
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/lists/memberships.json';
    }
}
