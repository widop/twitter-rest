<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\SavedSearches;

use Widop\Twitter\AbstractRequest;

/**
 * Saved searches list request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/saved_searches/list
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class SavedSearchesListRequest extends AbstractRequest
{
    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/saved_searches/list.json';
    }
}
