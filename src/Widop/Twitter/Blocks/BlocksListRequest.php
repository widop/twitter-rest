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
 * Blocks list request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/blocks/list
 *
 * @method boolean|null getIncludeEntities()                         Checks if the entities node should be included.
 * @method null         setIncludeEntities(boolean $includeEntities) Sets if the entities node should be included.
 * @method boolean|null getSkipStatus()                              Checks if the statuses should be included.
 * @method null         setSkipStatus(boolean $skipStatus)           Sets if the statuses should be included.
 * @method string|null  getCursor()                                  Gets the cursor.
 * @method null         setCursor(string $cursor)                    Sets the cursor.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class BlocksListRequest extends AbstractRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('include_entities')
            ->register('skip_status')
            ->register('cursor');
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/blocks/list.json';
    }
}
