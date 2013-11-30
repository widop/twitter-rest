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

use Widop\Twitter\Rest\AbstractRequest;
use Widop\Twitter\Rest\Options\OptionBag;

/**
 * Friendships incoming request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/friendships/incoming
 *
 * @method string|null  getCursor()                            Gets the cursor.
 * @method null         setCursor(string $cursor)              Sets the cursor.
 * @method boolean|null getStringifyIds()                      Gets if the tweets ids will be returned as strings.
 * @method null         setStringifyIds(boolean $stringifyIds) Sets if the tweets ids will be returned as strings.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class FriendshipsIncomingRequest extends AbstractRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('cursor')
            ->register('stringify_ids');
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/friendships/incoming.json';
    }
}
