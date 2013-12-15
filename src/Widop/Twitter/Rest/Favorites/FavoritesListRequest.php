<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Favorites;

use Widop\Twitter\Rest\AbstractGetRequest;
use Widop\Twitter\Rest\Options\OptionBag;

/**
 * Favorites list request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/favorites/list
 *
 * @method string|null  getUserId()                                  Gets the user ID to return results for.
 * @method null         setUserId(string $userId)                    Sets the user ID to return results for.
 * @method string|null  getScreenName()                              Gets the user screen name to return results for.
 * @method null         setScreenName(string $screenName)            Sets the user screen name to return results for.
 * @method integer|null getCount()                                   Gets the number of records to retrieve
 * @method null         setCount(integer $count)                     Sets the number of records to retrieve
 * @method string|null  getSinceId()                                 Gets the lower tweet ID.
 * @method null         setSinceId(string $sinceId)                  Sets the lower tweet ID.
 * @method string|null  getMaxId()                                   Gets the higher tweet ID.
 * @method null         setMaxId(string $maxId)                      Sets the higher tweet ID.
 * @method boolean|null getIncludeEntities()                         Checks if the entities node should be included.
 * @method null         setIncludeEntities(boolean $includeEntities) Sets if the entities node should be included.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class FavoritesListRequest extends AbstractGetRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('user_id')
            ->register('screen_name')
            ->register('count')
            ->register('since_id')
            ->register('max_id')
            ->register('include_entities');
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
        return '/favorites/list.json';
    }
}
