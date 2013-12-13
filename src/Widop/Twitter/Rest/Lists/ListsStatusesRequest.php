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
 * Lists statuses request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/lists/statuses
 *
 * @method string|null  getListId()                                  Gets the list id.
 * @method null         setListId(string $listId)                    Sets the list id.
 * @method string|null  getSlug()                                    Gets the list slug.
 * @method null         setSlug(string $slug)                        Sets the list slug.
 * @method string|null  getOwnerScreenName()                         Gets the screen name of the user owning the list.
 * @method null         setOwnerScreenName(string $screeName)        Sets the screen name of the user owning the list.
 * @method string|null  getOwnerId()                                 Gets the id of the user owning the list.
 * @method null         setOwnerId(string $ownerId)                  Sets the id of the user owning the list.
 * @method string|null  getSinceId()                                 Gets the lower tweet id.
 * @method null         setSinceId(string $sinceId)                  Sets the lower tweet id.
 * @method string|null  getMaxId()                                   Gets the higher tweet id.
 * @method null         setMaxId(string $maxId)                      Sets the higher tweet id.
 * @method integer|null getCount()                                   Gets the number of tweets to retrieve.
 * @method null         setCount(integer $count)                     Sets the number of tweets to retrieve.
 * @method boolean|null getIncludeEntities()                         Checks if the entities node should be included.
 * @method null         setIncludeEntities(boolean $includeEntities) Sets if the entities node should be included.
 * @method boolean|null getIncludeRts()                              Checks if the relative retweets is included.
 * @method null         setIncludeRts(boolean $includeRts)           Sets if the relative retweets is included.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class ListsStatusesRequest extends AbstractRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('list_id')
            ->register('slug')
            ->register('owner_screen_name')
            ->register('owner_id')
            ->register('since_id')
            ->register('max_id')
            ->register('count')
            ->register('include_entities')
            ->register('include_rts');
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        if (!isset($optionBag['list_id']) && !isset($optionBag['slug'])) {
            throw new \RuntimeException('You must provide a list id or slug.');
        }

        if (isset($optionBag['list_id'])) {
            unset($optionBag['slug']);
        }

        if (isset($optionBag['slug']) && !isset($optionBag['owner_screen_name']) && !isset($optionBag['owner_id'])) {
            throw new \RuntimeException(
                'You must provide the owner screen name or id in conjuction with the slug parameter.'
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/lists/statuses.json';
    }
}
