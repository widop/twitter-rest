<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\DirectMessages;

use Widop\Twitter\AbstractRequest;
use Widop\Twitter\Options\OptionBag;

/**
 * Direct messages sent request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/direct_messages/sent
 *
 * @method string|null  getSinceId()                                 Gets the lower direct message sent ID.
 * @method null         setSinceId(string $sinceId)                  Sets the lower direct message sent ID.
 * @method string|null  getMaxId()                                   Gets the higher direct message sent ID.
 * @method null         setMaxId(string $maxId)                      Sets the higher direct message sent ID.
 * @method integer|null getCount()                                   Gets the number of direct messages to retrieve.
 * @method null         setCount(integer $count)                     Sets the number of direct messages to retrieve.
 * @method integer|null getPage()                                    Gets the page of results to retrieve.
 * @method null         setPage(integer $page)                       Sets the page of results to retrieve.
 * @method boolean|null getIncludeEntities()                         Checks if the entities node should be included.
 * @method null         setIncludeEntities(boolean $includeEntities) Sets if the entities node should be included.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class DirectMessagesSentRequest extends AbstractRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('since_id')
            ->register('max_id')
            ->register('count')
            ->register('page')
            ->register('include_entities');
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/direct_messages/sent.json';
    }
}
