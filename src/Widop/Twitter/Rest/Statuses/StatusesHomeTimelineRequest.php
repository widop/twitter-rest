<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Statuses;

use Widop\Twitter\Rest\Options\OptionBag;

/**
 * Statuses home timeline request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/statuses/home_timeline
 *
 * @method boolean|null getExcludeReplies()                        Checks if the replies should be excluded.
 * @method null         setExcludeReplies(boolean $excludeReplies) Sets if the replies should be excluded.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class StatusesHomeTimelineRequest extends StatusesMentionsTimelineRequest
{
    /**
     * {@inheritdoc}
     */
    public function configureOptionBag(OptionBag $optionBag)
    {
        parent::configureOptionBag($optionBag);

        $optionBag->register('exclude_replies');
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/statuses/home_timeline.json';
    }
}
