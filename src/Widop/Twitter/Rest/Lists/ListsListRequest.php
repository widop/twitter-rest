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

use Widop\Twitter\Rest\AbstractGetRequest;
use Widop\Twitter\Rest\Options\OptionBag;

/**
 * Lists list request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/lists/list
 *
 * @method string|null  getUserId()                       Gets the user ID.
 * @method null         setUserId(string $userId)         Sets the user ID.
 * @method string|null  getScreenName()                   Gets the user screen name.
 * @method null         setScreenName(string $screenName) Sets the user screen name.
 * @method boolean|null getReverse()                      Checks if owned lists will be returned first.
 * @method null         setReverse(boolean $reverse)      Sets if owned lists will be returned first.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class ListsListRequest extends AbstractGetRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('user_id')
            ->register('screen_name')
            ->register('reverse');
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/lists/list.json';
    }
}
