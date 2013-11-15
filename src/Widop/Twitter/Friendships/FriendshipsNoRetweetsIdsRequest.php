<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Friendships;

use Widop\Twitter\AbstractRequest;
use Widop\Twitter\Options\OptionBag;

/**
 * Friendships no retweets ids request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/friendships/no_retweets/ids
 *
 * @method boolean|null getStringifyIds()                      Gets if the tweets ids will be returned as strings.
 * @method null         setStringifyIds(boolean $stringifyIds) Sets if the tweets ids will be returned as strings.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class FriendshipsNoRetweetsIdsRequest extends AbstractRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag->register('stringify_ids');
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/friendships/no_retweets/ids.json';
    }
}
