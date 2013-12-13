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

/**
 * Lists subscribers destroy request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/lists/subscribers/destroy
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class ListsSubscribersDestroyRequest extends AbstractListsSubscribersPostRequest
{
    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/lists/subscribers/destroy.json';
    }
}
