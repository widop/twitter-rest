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
 * Lists members create all request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/lists/members/create_all
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class ListsMembersCreateAllRequest extends AbstractListsMembersPostRequest
{
    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/lists/members/create_all.json';
    }
}
