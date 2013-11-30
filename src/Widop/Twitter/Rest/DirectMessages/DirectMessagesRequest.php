<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\DirectMessages;

use Widop\Twitter\Rest\AbstractRequest;
use Widop\Twitter\Rest\Options\OptionBag;

/**
 * Direct messages twitter request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/direct_messages
 *
 * @method string|null  getSinceId()                                 Gets the lower direct message ID.
 * @method null         setSinceId(string $sinceId)                  Sets the lower direct message ID.
 * @method string|null  getMaxId()                                   Gets the higher direct message ID.
 * @method null         setMaxId(string $maxId)                      Sets the higher direct message ID.
 * @method integer|null getCount()                                   Gets the number of direct messages to retrieve.
 * @method null         setCount(integer $count)                     Sets the number of direct messages to retrieve.
 * @method boolean|null getIncludeEntities()                         Checks if the entities node should be included.
 * @method null         setIncludeEntities(boolean $includeEntities) Sets if the entities node should be included.
 * @method boolean|null getSkipStatus()                              Checks if the statuses should be included.
 * @method null         setSkipStatus(boolean $skipStatus)           Sets if the statuses should be included.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class DirectMessagesRequest extends AbstractRequest
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
            ->register('include_entities')
            ->register('skip_status');
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/direct_messages.json';
    }
}
