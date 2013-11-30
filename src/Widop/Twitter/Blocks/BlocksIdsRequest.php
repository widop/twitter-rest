<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Blocks;

use Widop\Twitter\AbstractRequest;
use Widop\Twitter\Options\OptionBag;

/**
 * Blocks ids request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/blocks/ids
 *
 * @method boolean|null getStringifyIds()                      Gets if the ids will be returned as strings.
 * @method null         setStringifyIds(boolean $stringifyIds) Sets if the ids will be returned as strings.
 * @method string|null  getCursor()                            Gets the cursor.
 * @method null         setCursor(string $cursor)              Sets the cursor.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class BlocksIdsRequest extends AbstractRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('stringify_ids')
            ->register('cursor');
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/blocks/ids.json';
    }
}
